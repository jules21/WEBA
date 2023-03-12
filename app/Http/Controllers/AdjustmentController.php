<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdjustmentRequest;
use App\Http\Requests\UpdateAdjustmentRequest;
use App\Http\Requests\ValidateAdjustmentItemRequest;
use App\Http\Requests\ValidateReviewRequest;
use App\Models\Adjustment;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockMovementDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $query = Adjustment::with('operationArea');
        $query->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('operationArea', function ($query) use ($user) {
                $query->where('operator_id', $user->operator_id);
            });
        });
        $query->when($user->operation_area, function ($query) use ($user) {
            $query->where('operation_area_id', $user->operation_area);
        });
        $adjustments = $query->get();
        return view('admin.stock.adjustment.index', compact('adjustments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdjustmentRequest $request)
    {
        Adjustment::query()->create($request->validated());
        return back()->with('success', 'Adjustment created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdjustmentRequest $request, Adjustment $adjustment)
    {
        $updated = $adjustment->update($request->validated());
        if ($updated) {
            return back()->with('success', 'Adjustment updated successfully');
        }
        return back()->with('error', 'Adjustment update failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjustment $adjustment)
    {
        try {
            $adjustment->delete();
            return back()->with('success', 'Adjustment deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Adjustment delete failed');
        }
    }
    public function items(Adjustment $adjustment)
    {
        $items = $adjustment->items;
        $stock = Stock::query()->where('operation_area_id', $adjustment->operation_area_id)->get();
        return view('admin.stock.adjustment.items', compact('stock', 'items', 'adjustment'));
    }
    public function addItem(ValidateAdjustmentItemRequest $request, Adjustment $adjustment)
    {
        $data = $request->validated();

        $item = $adjustment->items()
            ->updateOrCreate(
                ['item_id' => $data['item_id']],
                [
                    'quantity' => $data['quantity'],
                    'type' => get_class($adjustment),
                    'unit_price' => 0,
                    'status' => 'pending'
                ]
            );


        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item saved successfully',
                'status' => 'success',
                'data' => $item
            ], 200);
        }

        return redirect()->back()
            ->with('success', 'Item saved successfully');

    }
    public function removeItem(Adjustment $adjustment, $id)
    {
        StockMovementDetail::query()->find($id)->delete();

        if (\request()->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully',
                'status' => 'success'
            ], 200);
        }

        return redirect()
            ->back()
            ->with('success', 'Item deleted successfully');

    }
    public function submit(Adjustment $adjustment)
    {
        if (!$adjustment->items()->exists())
            return redirect()->back()->with('error', 'Adjustment has no items');
        $adjustment->update(['status' => 'Submitted']);
        return redirect()->route('admin.stock.adjustments.index')->with('success', 'Adjustment submitted successfully');
    }
    public function show(Adjustment $adjustment)
    {
        $adjustment->load(['items.item', 'flowHistories.user']);

        $reviews = $adjustment->flowHistories
            ->where('is_comment', '=', true);

        $flowHistories = $adjustment->flowHistories
            ->where('is_comment', '=', false);

        return view('admin.stock.adjustment.details', [
            'adjustment' => $adjustment,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories
        ]);
    }

    public function review(ValidateReviewRequest $request, Adjustment $adjustment)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $adjustment) {
            $status = $data['status'];
            $this->saveFlowHistory($adjustment, $data['comment'], $status, true);

            $adjustment->update([
                'status' => $status,
                'approved_by' => auth()->id()
            ]);
            $this->saveFlowHistory($adjustment, "Adjustment {$status}", $status);

            if ($status == Adjustment::APPROVED) {
                $this->updateStockItems($adjustment);
            }

            $adjustment->items()->update([
                'status' => $status
            ]);
        });

        if (\request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Adjustment reviewed successfully'
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Adjustment reviewed successfully');

    }

    public function saveFlowHistory($model, $message, $status, $isComment = false): void
    {
        $model->flowHistories()
            ->create([
                'status' => $status,
                'user_id' => auth()->id(),
                'comment' => $message,
                'type' => get_class($model),
                'is_comment' => $isComment
            ]);
    }
    public function updateStockItems(Adjustment $adjustment): void
    {
        foreach ($adjustment->items()->get() as $movement) {
            $this->updateStockMovement($movement, $adjustment);

            $stockItem = Stock::where('item_id', '=', $movement->item_id)
                ->where('operation_area_id', '=', $adjustment->operation_area_id)
                ->first();

            $stockItem->update([
                'quantity' => $stockItem->quantity - $movement->qty_in
            ]);
        }
    }

    public function updateStockMovement($movement, Adjustment $adjustment): void
    {
        $item_id = $movement->item_id;
        $item = Item::find($item_id);
        $prevStockItem = Stock::with('item')
            ->where('item_id', '=', $item_id)
            ->where('operation_area_id', '=', $adjustment->operation_area_id)
            ->first();

        $adjustment->movements()->create([
            'item_id' => $item_id,
            'opening_qty' => $prevStockItem->quantity ?? 0,
            'qty_in' => $movement->quantity,
            'qty_out' => 0,
            'operation_area_id' => auth()->user()->operation_area,
            'type' => get_class($adjustment),
            'unit_price' => $movement->unit_price ?? 0,
            'vat' => $movement->vat ?? 0,
            'description' => "Adjustment of {$item->name} done  due to {$adjustment->description}  ",
        ]);
    }
}
