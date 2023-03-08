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
        $datatable =  new StockMovementsDataTable();
        return $datatable->render('admin.stock.items_movement');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Illuminate\Http\Response
     */
    public function show(StockMovement $stockMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(StockMovement $stockMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockMovement $stockMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockMovement  $stockMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockMovement $stockMovement)
    {
        //
    }
}
