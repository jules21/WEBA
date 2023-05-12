<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsDataTable;
use App\Http\Requests\StoreItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\PackagingUnit;
use Illuminate\Http\JsonResponse;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (! \Helper::isOperator()) {
            abort(403);
        }

        return view('admin.stock.item_categories', [
            'categories' => ItemCategory::query()->where('operator_id', auth()->user()->operator_id)->get(),
        ]);
    }

    public function items(ItemCategory $itemCategory)
    {
        if (! \Helper::isOperator()) {
            abort(403);
        }

        $items = Item::query()
            ->where('item_category_id', $itemCategory->id)
            ->where('operator_id', auth()->user()->operator_id)
            ->select('items.*')->with('category', 'packagingUnit');

        $dataTable = new ItemsDataTable($items);

        return $dataTable->render('admin.stock.items', [
            'category' => $itemCategory,
            'categories' => ItemCategory::query()->where('operator_id', auth()->user()->operator_id)->get(),
            'units' => PackagingUnit::query()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreItemCategoryRequest $request)
    {
        ItemCategory::query()->create($request->validated());

        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateItemCategoryRequest $request, ItemCategory $itemCategory)
    {
        $itemCategory->update($request->validated());

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ItemCategory $itemCategory)
    {
        try {
            $itemCategory->delete();
            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (\Exception $exception) {
            info($exception->getMessage());
            return redirect()->back()->with('error', 'Category cannot be deleted, it has items attached to it');
        }
    }
}
