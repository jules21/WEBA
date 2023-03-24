<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Models\ItemCategory;
use Illuminate\Http\JsonResponse;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!\Helper::isOperator())
            abort(403);
        return view('admin.stock.item_categories',[
            'categories'=>ItemCategory::query()->where('operator_id', auth()->user()->operator_id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemCategoryRequest $request)
    {
        ItemCategory::query()->create($request->validated());
        return redirect()->back()->with('success','Category created successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemCategoryRequest  $request
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemCategoryRequest $request, ItemCategory $itemCategory)
    {
        $itemCategory->update($request->validated());
        return redirect()->back()->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategory  $itemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();
//        return new JsonResponse(['status'=>'success']);
        return redirect()->back()->with('success','Category deleted successfully');
    }
}
