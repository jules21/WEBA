<?php

namespace App\Http\Controllers;

use App\Models\Adjustment;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\StockMovementDetail;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $stock = Stock::with('operationArea','item','item.category');

        $stock->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('operationArea', function ($query) use ($user) {
                $query->where('operator_id', $user->operator_id);
            });
        });
        $stock->when($user->operation_area, function ($query) use ($user) {
            $query->where('operation_area_id', $user->operation_area);
        });
        $stock->when($request->has('operator_id'), function ($query) use ($request) {
            $query->whereHas('operationArea', function ($query) use ($request) {
                $query->whereIn('operator_id', $request->operator_id);
            });
        });
        $stock->when($request->has('operation_area_id'), function ($query) use ($request) {
            $query->whereIn('operation_area_id', $request->operation_area_id);
        });
        $stock->when($request->has('item_category_id'), function ($query) use ($request) {
            $query->whereHas('item', function ($query) use ($request) {
                $query->whereIn('item_category_id', $request->item_category_id);
            });
        });
        $stock->when($request->has('item_id'), function ($query) use ($request) {
            $query->whereIn('item_id', $request->item_id);
        });
        //get stock items


        return view('admin.stock.stock', [
            'operators' => Operator::query()->get(),
            'items' => Item::query()->get(),
            'categories' => ItemCategory::query()->get(),
            'stocks' => $stock->get(),
            'operationAreas' => $user->operator_id ? OperationArea::query()->where('operator_id', $user->operator_id)->get() : OperationArea::query()->get(),
        ]);
    }
    public function show(Stock $stock)
    {
        $movements = StockMovement::query()
                    ->where('item_id', $stock->item_id)
                    ->where('operation_area_id', $stock->operation_area_id)
                    ->with('item', 'operationArea.operator')
                    ->get();
        return view('admin.stock.stock_details', compact('stock','movements'));
    }
}
