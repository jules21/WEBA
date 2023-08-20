<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsDataTable;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Operator;
use App\Models\PackagingUnit;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!\Helper::isOperator()) {
            abort(403);
        }
        $items = Item::query()
            ->select('items.*');
        $dataTable = new ItemsDataTable($items);

        return $dataTable->render('admin.stock.items', [
            'categories' => ItemCategory::query()->get(),
            'units' => PackagingUnit::query()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();

//        if (!$validated['vatable'])
//            $validated['vat_rate'] = 0;

        Item::query()->create($validated);

        return redirect()->back()->with('success', 'Item created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();

//        if (!$validated['vatable'])
//            $validated['vat_rate'] = 0;

        $item->update($validated);

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */
    public function destroy(Item $item)
    {
        try {
            $item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (Exception $exception) {
            info('Item cannot be deleted', [
                'item' => $item->toArray(),
                'exception' => $exception->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Item cannot be deleted');
        }
    }

    public function stock(Operator $operator)
    {
        return view('admin.stock.stock', [
            'operator' => $operator,
            'items' => Item::query()->select('items.*')->with('category', 'packagingUnit')->get(),
        ]);
    }

    public function itemsByCategory($categoryId)
    {
        return Item::query()
            ->where('item_category_id','=', $categoryId)
            ->get();
    }

    public function getItemsByCategories()
    {

        $categoryyIds = request()->input('item_category_id');
        if (empty($categoryyIds)) {
            return [];
        }
        $items = Item::query()->whereIn('item_category_id', $categoryyIds)
            ->with('category')
            ->get();

        return $items;
    }

    public function getItemUnitPrice(Item $item)
    {
        return $this->getItemLastUnitPrice($item);
    }
}
