<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\StockMovement;
use App\Models\Supplier;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class PurchaseController extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Purchase::query()
                ->with('supplier');

            return datatables()->eloquent($data)
                ->addColumn('action', function (Purchase $row) {
                    $btn = '<a href="" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.purchases.index');

    }


    public function create()
    {
        $suppliers = Supplier::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')
            ->get();

        $items = Item::query()
            ->orderBy('name')
            ->get();


        return view('admin.purchases.create', [
            'suppliers' => $suppliers,
            'items' => $items
        ]);
    }


    /**
     * @throws Throwable
     */
    public function store(ValidatePurchaseRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        $purchase = Purchase::create([
            'supplier_id' => $data['supplier_id'],
            'description' => $data['description'],
            'created_by' => auth()->id(),
            'status' => Purchase::PENDING
        ]);

        foreach ($data['items'] as $item) {
            $itemId = $item['item_id'];
            $existingItem = Item::query()->find($itemId);
            $purchase->movements()->create([
                'item_id' => $itemId,
                'operation_area_id' => auth()->user()->operation_area,
                'opening_qty' => $existingItem->quantity,
                'qty_in' => $item['quantity'],
                'qty_out' => 0,
                'unit_price' => $item['unit_price'],
                'description' => "Purchase of {$item['quantity']} {$existingItem->name} from {$purchase->supplier->name}",
                'type' => StockMovement::Purchase,
            ]);
        }

        DB::commit();

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Purchase created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Purchase $purchase
     * @return void
     */
    public function show(Purchase $purchase)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Purchase $purchase
     * @return Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Purchase $purchase
     * @return Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }


    /**
     * @throws Throwable
     */
    public function destroy(Purchase $purchase)
    {
        DB::beginTransaction();
        $purchase
            ->movements()
            ->delete();

        $purchase->delete();

        DB::commit();
        if (\request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Purchase deleted successfully'
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Purchase deleted successfully');
    }
}
