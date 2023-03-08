<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Stock;
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
                ->with(['supplier'])
                ->where('operation_area_id', '=', auth()->user()->operation_area)
                ->withCount('movements');

            return datatables()->of($data)
                ->editColumn('supplier_nane', function ($row) {
                    return $row->supplier->name;
                })
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

//        return $data;

        DB::beginTransaction();

        $purchase = Purchase::create([
            'supplier_id' => $data['supplier_id'],
            'description' => $data['description'],
            'created_by' => auth()->id(),
            'status' => Purchase::PENDING,
            'subtotal' => $data['subtotal'],
            'tax_amount' => $data['tax_amount'],
            'tax_net_amount' => $data['tax_amount'],
            'total' => $data['grand_total'],
            'operation_area_id' => auth()->user()->operation_area
        ]);

        foreach ($data['items'] as $key => $item) {
            $stockItem = Stock::with('item')->where('item_id', '=', $item)->first();
            $existingItem = Item::find($item);
            $qty = $data['quantities'][$key];
            $price = $data['prices'][$key];
            $purchase->movements()->create([
                'item_id' => $item,
                'operation_area_id' => auth()->user()->operation_area,
                'opening_qty' => $stockItem->quantity ?? 0,
                'qty_in' => $qty,
                'qty_out' => 0,
                'unit_price' => $price,
                'description' => "Purchase of {$qty} {$existingItem->name} at " . number_format($price, 2),
                'type' => StockMovement::Purchase,
            ]);
        }
        DB::commit();

        return redirect()
            ->route('admin.purchases.index')
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
