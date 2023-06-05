<?php

namespace App\Http\Controllers;

use App\DataTables\StockMovementsDataTable;
use App\Exports\StockMovementExport;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemSellingPrice;
use App\Models\OperationArea;
use App\Models\StockMovement;
use Excel;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        $data = StockMovement::with('item', 'operationArea.operator','item.packagingUnit','item.stock.operationArea')->select('stock_movements.*');
        $data->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('operationArea', function ($query) use ($user) {
                $query->where('operator_id', $user->operator_id);
            });
        });
        $data->when($user->operation_area, function ($query) use ($user) {
            $query->where('operation_area_id', $user->operation_area);
        });
        $data->when(request()->has('operation_area_id'), function ($query) {
            $query->whereIn('operation_area_id', request()->operation_area_id);
        });
        $data->when(request()->item_id, function ($query) {
            $query->whereIn('item_id', request()->item_id);
        });
        $data->when(request()->item_category_id, function ($query) {
            $query->whereHas('item', function ($query) {
                $query->whereIn('item_category_id', request()->item_category_id);
            });
        });
        $data->when(request()->type, function ($query) {
            $query->whereIn('type', request()->type);
        });
        $datatable = new StockMovementsDataTable($data);

        //export
        if (request()->is_download == true && ! \request()->ajax()) {
            return $this->exportStockMovement($data->get());
        }

        return $datatable->render('admin.stock.items_movement',
            [
                'categories' => ItemCategory::query()->where('operator_id', $user->operator_id)->get(),
                'items' => [], // Item::query()->where('operator_id', $user->operator_id)->get(),
                'operationAreas' => $user->operator_id ? OperationArea::query()->where('operator_id', $user->operator_id)->get() : OperationArea::query()->get(),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportStockMovement($query)
    {
        return Excel::download(new StockMovementExport($query), 'Stock Movement List.xlsx');
    }

    public function history($movement)
    {
        $movement = StockMovement::with('item')->findOrFail(decryptId($movement));
        $histories = ItemSellingPrice::query()->with(['item'])
            ->where('parent_movement_id', $movement->id)
            ->get();
        return view('admin.stock.movement_history', compact('movement', 'histories'));
    }
}
