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
        $data = StockMovement::with('item', 'operationArea.operator')->select('stock_movements.*');
        $datatable =  new StockMovementsDataTable($data);
        return $datatable->render('admin.stock.items_movement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Illuminate\Http\Response
     */
    public function show(StockMovement $movement){
        return view('admin.stock.movement_details', compact('movement'));
    }


}
