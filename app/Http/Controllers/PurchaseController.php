<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Constants\Status;
use App\Http\Requests\ValidatePurchaseRequest;
use App\Http\Requests\ValidateReviewRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Supplier;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;
use function request;

class PurchaseController extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {

        if (request()->ajax()) {
            $data = Purchase::query()
                ->with(['supplier'])
                ->where('operation_area_id', '=', auth()->user()->operation_area)
                ->withCount('movementDetails')
                ->where(function (Builder $builder) {
                    if (request('type') == 'all') {
                        return;
                    }
                    $statuses = [];
                    if (auth()->user()->can(Permission::StockInItems)) {
                        $statuses[] = Status::RETURN_BACK;
                    }
                    if (auth()->user()->can(Permission::ApproveStockIn)) {
                        $statuses[] = Status::SUBMITTED;
                    }

                    $builder->whereIn('status', $statuses);
                });

            return datatables()->of($data)
                ->editColumn('supplier_nane', function ($row) {
                    return $row->supplier->name;
                })
                ->addColumn('action', function (Purchase $row) {
                    $editBtn = '';
                    $deleteBtn = '';
                    $submitBtn = '';
                    if ($row->status == Status::RETURN_BACK && auth()->user()->can(Permission::StockInItems)) {
                        /*  $submitBtn = '<a href="' . route('admin.purchases.submit', encryptId($row->id)) . '" class="dropdown-item js-submit"><i class="fa fa-cloud-upload-alt mr-2"></i> Submit</a>';*/
                        $editBtn = '<a href="' . route('admin.purchases.edit', encryptId($row->id)) . '" class="dropdown-item"><i class="fa fa-edit mr-2"></i> Edit</a>';
                        $deleteBtn = '<a href="' . route('admin.purchases.destroy', encryptId($row->id)) . '" class="dropdown-item js-delete"><i class="fa fa-trash mr-2"></i> Delete</a>';
                    }

                    return '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="' . route('admin.purchases.show', encryptId($row->id)) . '">
                                    <i class="fa fa-info-circle mr-2"></i>
                                    View</a>
                                    ' . $submitBtn . '
                                    ' . $editBtn . '
                                    ' . $deleteBtn . '
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.purchases.index');

    }

    /**
     * @throws Throwable
     */
    public function submit(Purchase $purchase)
    {
        DB::beginTransaction();
        if ($purchase->status == Status::PENDING) {
            $purchase->update([
                'status' => Status::SUBMITTED,
            ]);
        }

        $this->saveFlowHistory($purchase, 'Purchase submitted', Status::SUBMITTED);

        DB::commit();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Purchase submitted successfully',
            ]);
        }

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase submitted successfully');

    }

    public function create()
    {
        $suppliers = $this->getSuppliers();

        $categories = $this->getCategories();

        return view('admin.purchases.create', [
            'suppliers' => $suppliers,
            'categories' => $categories,
            'items' => $this->getitems(),
        ]);

    }

    /**
     * @throws Throwable
     */
    public function store(ValidatePurchaseRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        $purchase = Purchase::create($this->getPurchaseData($data));

        $this->saveItems($data, $purchase);

        $this->saveFlowHistory($purchase, 'Purchase created', Status::PENDING);

        DB::commit();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return Application|Factory|View
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['movementDetails.item', 'supplier', 'flowHistories.user']);

        $reviews = $purchase->flowHistories
            ->where('is_comment', '=', true);

        $flowHistories = $purchase->flowHistories
            ->where('is_comment', '=', false);

        return view('admin.purchases.details', [
            'purchase' => $purchase,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories,
        ]);
    }

    public function edit(Purchase $purchase)
    {
        if ($purchase->status != Status::RETURN_BACK) {
            return redirect()
                ->back()
                ->with('error', 'Purchase cannot be edited');
        }

        $suppliers = $this->getSuppliers();

        $categories = $this->getCategories();

        $purchase->load(['movementDetails.item']);

        return view('admin.purchases.create', [
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'items' => $this->getItems(),
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     *
     * @throws Throwable
     */
    public function update(ValidatePurchaseRequest $request, Purchase $purchase)
    {
        $data = $request->validated();

        if ($purchase->status != Status::RETURN_BACK) {
            return redirect()
                ->back()
                ->with('error', 'Purchase cannot be edited');
        }

        DB::beginTransaction();

        $purchaseData = $this->getPurchaseData($data);
        $purchaseData['return_back_status'] = Status::RE_SUBMITTED;
        $purchase->update($purchaseData);

        $purchase->movementDetails()->delete();

        $this->saveItems($data, $purchase);

        $this->saveFlowHistory($purchase, 'Purchase updated', Status::SUBMITTED);

        DB::commit();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase updated successfully');
    }

    /**
     * @throws Throwable
     */
    public function destroy(Purchase $purchase)
    {
        if ($purchase->status != Status::PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'Purchase cannot be deleted',
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }

        DB::beginTransaction();
        $purchase->movementDetails()->delete();

        $purchase->flowHistories()->delete();

        $purchase->delete();

        DB::commit();
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Purchase deleted successfully',
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Purchase deleted successfully');
    }

    /**
     * @param $purchase
     * @param $message
     * @param $status
     * @param bool $isComment
     * @param string|null $fileName
     */
    public function saveFlowHistory($purchase, $message, $status, bool $isComment = false, string $fileName = null): void
    {
        $purchase->flowHistories()
            ->create([
                'status' => $status,
                'user_id' => auth()->id(),
                'comment' => $message,
                'type' => $purchase->getClassName(),
                'is_comment' => $isComment,
                'attachment' => $fileName,
            ]);
    }

    /**
     * @throws Throwable
     */
    public function submitReview(ValidateReviewRequest $request, Purchase $purchase)
    {
        $data = $request->validated();

        DB::beginTransaction();

        $status = $data['status'];
        $fileName = null;
        if ($request->hasFile('attachment')) {
            $fileName = $request->file('attachment')->store(Purchase::ATTACHMENT_PATH);
        }

        $this->saveFlowHistory($purchase, $data['comment'], $status, true, $fileName);

        $purchase->update([
            'status' => $status,
            'approved_by' => auth()->id(),
            'return_back_status' => $status == Status::RETURN_BACK ? Status::RETURN_BACK : null
        ]);
        $this->saveFlowHistory($purchase, "Purchase $status", $status);

        // if purchase is approved, update stock items quantity if not exist create new

        if ($status == Status::APPROVED) {
            $this->updateStockItems($purchase);
        }


        $purchase->movementDetails()->update([
            'status' => $status,
        ]);

        DB::commit();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Purchase reviewed successfully',
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Purchase reviewed successfully');

    }

    public function updateStockItems(Purchase $purchase): void
    {
        foreach ($purchase->movementDetails()->get() as $movement) {
            $this->updateStockMovement($movement, $purchase);

            $stockItem = Stock::where('item_id', '=', $movement->item_id)
                ->where('operation_area_id', '=', auth()->user()->operation_area)
                ->first();

            if (!$stockItem) {
                $stockItem = Stock::create([
                    'item_id' => $movement->item_id,
                    'operation_area_id' => auth()->user()->operation_area,
                    'quantity' => 0,
                ]);
            }

            $stockItem->update([
                'quantity' => $stockItem->quantity + $movement->quantity,
            ]);
        }
    }

    public function getSuppliers()
    {
        return Supplier::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')
            ->get();
    }

    public function getCategories()
    {
        return ItemCategory::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')
            ->whereHas('items')
            ->get();
    }

    public function getItems()
    {
        return Item::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')
            ->get();
    }

    public function getItemCategories()
    {
        return ItemCategory::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')
            ->get();
    }

    public function saveItems(array $data, $purchase): void
    {
        foreach ($data['items'] as $key => $item) {
            $qty = $data['quantities'][$key];
            $price = $data['prices'][$key];
            $vat = $data['vat_values'][$key];
            $purchase->movementDetails()->create([
                'item_id' => $item,
                'quantity' => $qty,
                'unit_price' => $price,
                'type' => StockMovement::StockIn,
                'vat' => $vat,
                'status' => Status::PENDING,
            ]);
        }
    }

    public function getPurchaseData(array $data): array
    {
        return [
            'supplier_id' => $data['supplier_id'],
            'description' => $data['description'],
            'created_by' => auth()->id(),
            'status' => Status::SUBMITTED,
            'tax_amount' => $data['tax_amount'],
            'total' => $data['grand_total'],
            'operation_area_id' => auth()->user()->operation_area,
        ];
    }

    public function updateStockMovement($movement, Purchase $purchase): void
    {
        $item_id = $movement->item_id;
        $item = Item::find($item_id);
        $prevStockItem = Stock::with('item')
            ->where('item_id', '=', $item_id)->first();

        $purchase->movements()->create([
            'item_id' => $item_id,
            'opening_qty' => $prevStockItem->quantity ?? 0,
            'qty_in' => $movement->quantity,
            'qty_out' => 0,
            'operation_area_id' => auth()->user()->operation_area,
            'type' => StockMovement::StockIn,
            'unit_price' => $movement->unit_price,
            'vat' => $movement->vat,
            'description' => "Purchase of $item->name from {$purchase->supplier->name}  ",
        ]);
    }
}
