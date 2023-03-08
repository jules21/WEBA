<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsDataTable;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Operator;
use App\Models\PackagingUnit;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::query()->select('items.*')->with('category','packagingUnit');
        $dataTable = new ItemsDataTable($items);
        return $dataTable->render('admin.stock.items', [
            'categories' => ItemCategory::query()->get(),
            'units' => PackagingUnit::query()->get()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        Item::query()->create($request->validated());
        return redirect()->back()->with('success', 'Item created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->validated());
        return redirect()->back()->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {
            $item->delete();
            return redirect()->back()->with('success', 'Item deleted successfully');
        }catch (\Exception $exception){
            info('Item cannot be deleted', [
                'item' => $item->toArray(),
                'exception' => $exception->getMessage()
            ]);
            return redirect()->back()->with('error', 'Item cannot be deleted');
        }
    }

    public function stock(Operator $operator)
    {
        return view('admin.stock.stock', [
            'operator' => $operator,
            'items' => Item::query()->select('items.*')->with('category','packagingUnit')->get()
        ]);
    }
}
