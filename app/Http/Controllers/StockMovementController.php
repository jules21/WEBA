<?php

namespace App\Http\Controllers;

use App\DataTables\StockMovementsDataTable;
use App\Exports\StockMovementExport;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\StockMovement;
use Excel;
use Illuminate\Http\Request;

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
        $data = StockMovement::with('item', 'operationArea.operator')->select('stock_movements.*');
        $data->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('operationArea', function ($query) use ($user) {
                $query->where('operator_id', $user->operator_id);
            });
        });
        $data->when($user->operation_area, function ($query) use ($user) {
            $query->where('operation_area_id', $user->operation_area);
        });
        $data->when(request()->item_id, function ($query) {
            $query->whereItem_id(request()->item_id);
        });
        $data->when(request()->item_category_id, function ($query) {
            $query->whereHas('item', function ($query) {
                $query->whereIn('item_category_id', request()->item_category_id);
            });
        });
        $datatable =  new StockMovementsDataTable($data);

        //export
        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportStockMovement($data->get());
        }

        return $datatable->render('admin.stock.items_movement',
            [
                'categories' => ItemCategory::query()->where('operator_id', $user->operator_id)->get(),
                'items' =>[]// Item::query()->where('operator_id', $user->operator_id)->get(),
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


}
