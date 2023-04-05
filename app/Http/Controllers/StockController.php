<?php

namespace App\Http\Controllers;

use App\Exports\StockCardExport;
use App\Exports\StockExport;
use App\Models\Adjustment;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\StockMovementDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $stock = $stock->get();
        //expected response
        $items = Item::query()->with('category')->where('operator_id', $user->operator_id);
        $items->when($request->has('item_category_id'), function ($query) use ($request) {
            $query->whereIn('item_category_id', $request->item_category_id);
        });
        $items->when($request->has('item_id'), function ($query) use ($request) {
            $query->whereIn('id', $request->item_id);
        });
        $items = $items->get();
        $stock_data = $items->map(function ($item)use($user,$stock){
            $item->quantity = collect($stock)
                ->where('item_id', $item->id)
                ->where('operation_area_id', $user->operation_area)
                ->sum('quantity');
            return $item;
        });
        //export
        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportStock($stock_data);
        }


        return view('admin.stock.stock', [
            'operators' => Operator::query()->get(),
            'items' =>[],// Item::query()->get(),
            'categories' => ItemCategory::query()->where('operator_id', $user->operator_id)->get(),
            'stocks' => $stock_data,
            'operationAreas' => $user->operator_id ? OperationArea::query()->where('operator_id', $user->operator_id)->get() : OperationArea::query()->get(),
        ]);
    }
    public function show($item)
    {
        $item = Item::query()->find(decryptId($item));
        $movements = StockMovement::query()
                    ->where('item_id', $item->id)
                    ->where('operation_area_id', auth()->user()->operation_area)
                    ->with('item', 'operationArea.operator')
                    ->get();
        //export
        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportStockCard($movements);
        }
        return view('admin.stock.stock_details', compact('item','movements'));
    }

    public function exportStock($query)
    {
        return Excel::download(new StockExport($query), 'Stock List.xlsx');
    }
    public function exportStockCard($query)
    {
        return Excel::download(new StockCardExport($query), 'Stock Card List.xlsx');
    }

}
