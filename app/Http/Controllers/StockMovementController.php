<?php

namespace App\Http\Controllers;

use App\DataTables\StockMovementsDataTable;
use App\Models\StockMovement;
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
        $datatable =  new StockMovementsDataTable($data);
        return $datatable->render('admin.stock.items_movement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Illuminate\Http\Response
     */
//    public function show(StockMovement $movement){
//        return view('admin.stock.movement_details', compact('movement'));
//    }


}
