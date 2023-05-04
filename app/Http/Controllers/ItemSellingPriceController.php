<?php

namespace App\Http\Controllers;

use App\Models\ItemSellingPrice;
use Illuminate\Http\Request;

class ItemSellingPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_selling_prices = ItemSellingPrice::query()->filter(request(['item_id', 'operation_area_id', 'stock_movement_id', 'price', 'currency_id']))->get();
        return view('item_selling_price.index', [
            'item_selling_prices' => $item_selling_prices,
            'item_id' => request('item_id'),
            'operation_area_id' => request('operation_area_id'),
            'stock_movement_id' => request('stock_movement_id'),
            'price' => request('price'),
            'currency_id' => request('currency_id'),
            'items' => Item::query()->get(),
            'operation_areas' => OperationArea::query()->get(),
            'stock_movements' => StockMovement::query()->get(),
            'currencies' => Currency::query()->get(),
        ]);
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
     * @param  \App\Models\ItemSellingPrice  $itemSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSellingPrice $itemSellingPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemSellingPrice  $itemSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemSellingPrice $itemSellingPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSellingPrice  $itemSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemSellingPrice $itemSellingPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSellingPrice  $itemSellingPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSellingPrice $itemSellingPrice)
    {
        //
    }
}
