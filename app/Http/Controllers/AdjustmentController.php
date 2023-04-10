<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Constants\Status;
use App\Http\Requests\StoreAdjustmentRequest;
use App\Http\Requests\UpdateAdjustmentRequest;
use App\Http\Requests\ValidateAdjustmentItemRequest;
use App\Http\Requests\ValidateReviewRequest;
use App\Models\Adjustment;
use App\Models\Item;
use App\Models\Request;
use App\Models\Stock;
use App\Traits\GetClassName;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class AdjustmentController extends Controller
{
    use GetClassName;

    const ADJUSTMENT_ATTACHMENT_PATH ='attachments/purchases';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $query = $this->extracted($user);
        $adjustments = $query->get();

        return view('admin.stock.adjustment.index', compact('adjustments'));
    }

    public function myTasks()
    {
        $user = auth()->user();
        if (! $user->can(Permission::ApproveAdjustment)) {
            return redirect()->back()->with('error', 'You are not a reviewer');
        }

        $query = $this->extracted($user);
        $adjustments = $query->where('status', Adjustment::SUBMITTED)->get();

        return view('admin.stock.adjustment.index', compact('adjustments'));
    }

    public function create()
    {
        $user = auth()->user();
        if (! $user->can(Permission::CreateAdjustment)) {
            return redirect()->back()->with('error', 'You are not allowed to create adjustment');
        }

        $query = $this->extracted($user);
        $adjustments = $query->WhereIn('status', [Adjustment::PENDING, Adjustment::SUBMITTED,Status::RETURN_BACK])->get();

        return view('admin.stock.adjustment.index', compact('adjustments'));
    }

    public function store(StoreAdjustmentRequest $request)
    {
        $adjustmentId = \request('adjustment_id');
        $adjustment = Adjustment::query()->find($adjustmentId);
        if ($adjustment) {
            $adjustment->update($request->validated());
            $this->saveFlowHistory($adjustment, 'Adjustment updated', Adjustment::PENDING);
        }else{
            $adjustment =  Adjustment::query()->create($request->validated());
            session()->forget('adjustment_id');
            session()->put('adjustment_id', $adjustment->id);
            $this->saveFlowHistory($adjustment, 'Adjustment created', Adjustment::PENDING);
        }
        return $adjustment;

//        $adjustment =  Adjustment::query()->create($request->validated());
//        $this->saveFlowHistory($adjustment, 'Adjustment created', Adjustment::PENDING);
//        return back()->with('success', 'Adjustment created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdjustmentRequest $request, Adjustment $adjustment)
    {
        $updated = $adjustment->update($request->validated());
        if ($updated) {
            return back()->with('success', 'Adjustment updated successfully');
        }
        return back()->with('error', 'Adjustment update failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Adjustment $adjustment)
    {
        try {

            if (session()->has('adjustment_id')) {
                session()->forget('adjustment_id');
            }

            $adjustment->items()->delete();
            $adjustment->delete();

            return back()->with('success', 'Adjustment deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Adjustment delete failed');
        }
    }

    public function items(Adjustment $adjustment)
    {
        $items = $adjustment->items;
        $stock = Stock::query()->where('operation_area_id', $adjustment->operation_area_id)->get();

        return view('admin.stock.adjustment.items', compact('stock', 'items', 'adjustment'));
    }
    public function addItem(ValidateAdjustmentItemRequest $request)
    {
        $adjustment = Adjustment::query()->find($request->adjustment_id);
        session()->put('adjustment_id', $adjustment->id);
        $data = $request->validated();

        $item = $adjustment->items()
            ->updateOrCreate(
                ['item_id' => $data['item_id']],
                [
                    'quantity' => $data['quantity'],
                    'type' => (new ReflectionClass(Adjustment::class))->getShortName(),
                    'unit_price' => $data['unit_price'],
                    'adjustment_type' => $data['adjustment_type'],
                    'status' => Adjustment::PENDING,
                    'description' => $data['description']
                ]
            );

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Item saved successfully',
                'status' => 'success',
                'data' => $item,
            ], 200);
        }

        return redirect()->back()
            ->with('success', 'Item saved successfully');

    }

    public function removeItem(Adjustment $adjustment, $id)
    {
        $id = decryptId($id);
        $adjustment->items()->where('id', $id)->delete();

        if (\request()->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully',
                'status' => 'success',
            ], 200);
        }

        return redirect()
            ->back()
            ->with('success', 'Item deleted successfully');

    }

    public function submit(\Illuminate\Http\Request $request, Adjustment $adjustment)
    {
        if ($request->has('attachment') && $request->file('attachment')->isValid()) {
            $file = $request->file('attachment');
            $destinationPath = self::ADJUSTMENT_ATTACHMENT_PATH;
            $path = $file->store($destinationPath);
            $attachment = str_replace($destinationPath, '', $path);
            $adjustment->attachment = $attachment;
            $adjustment->save();
        }

        if (!$adjustment->items()->exists())
            return redirect()->back()->with('error', 'Adjustment has no items');
        $adjustment->update(['status' => 'Submitted']);
        session()->forget('adjustment_id');
        return redirect()->route('admin.stock.adjustments.create')->with('success', 'Adjustment submitted successfully');
    }

    public function show(Adjustment $adjustment)
    {
        $adjustment->load(['items.item', 'flowHistories.user']);

        $reviews = $adjustment->flowHistories
            ->where('is_comment', '=', true);

        $flowHistories = $adjustment->flowHistories
            ->where('is_comment', '=', false);

        $stock = Stock::query()->where('operation_area_id', $adjustment->operation_area_id)->get();

        return view('admin.stock.adjustment.details', [
            'adjustment' => $adjustment,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories,
            'stock' => $stock,
        ]);
    }

    public function review(ValidateReviewRequest $request, Adjustment $adjustment)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $adjustment, $request) {
            $status = $data['status'];
            $fileName = null;
            if ($request->hasFile('attachment')) {
                $fileName =
                    $request->file('attachment')->store(AdjustmentController::ADJUSTMENT_ATTACHMENT_PATH);
            }
            $this->saveFlowHistory($adjustment, $data['comment'], $status, true,$fileName);

            $adjustment->update([
                'status' => $status,
                'approved_by' => auth()->id(),
                'return_back_status' => $status == Status::RETURN_BACK ? Status::RETURN_BACK : null,
            ]);
            $this->saveFlowHistory($adjustment, "Adjustment {$status}", $status);

            if ($status == Adjustment::APPROVED) {
                $this->updateStockItems($adjustment);
            }

            $adjustment->items()->update([
                'status' => $status,
            ]);
        });

        if (\request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Adjustment reviewed successfully',
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Adjustment reviewed successfully');

    }

    public function saveFlowHistory($model, $message, $status, $isComment = false, $fileName = null)
    {
        $test = $model->flowHistories()
            ->create([
                'status' => $status,
                'user_id' => auth()->id(),
                'comment' => $message,
                'type' => (new ReflectionClass(Adjustment::class))->getShortName(),
                'is_comment' => $isComment,
                'attachment' => $fileName,
            ]);
    }

    public function updateStockItems(Adjustment $adjustment): void
    {
        foreach ($adjustment->items()->get() as $movement) {
            $this->updateStockMovement($movement, $adjustment);

            $stockItem = Stock::where('item_id', '=', $movement->item_id)
                ->where('operation_area_id', '=', $adjustment->operation_area_id)
                ->first();

            if (!$stockItem) {
                $stockItem = Stock::create([
                    'item_id' => $movement->item_id,
                    'operation_area_id' => auth()->user()->operation_area,
                    'quantity' => 0,
                ]);
            }

            $quantity = $movement->adjustment_type == 'increase' ? $movement->quantity : -$movement->quantity;
            $stockItem->update([
                'quantity' => $stockItem->quantity + $quantity,
            ]);
        }
    }

    public function updateStockMovement($movement, Adjustment $adjustment): void
    {
        $item_id = $movement->item_id;
        $item = Item::find($item_id);
        $prevStockItem = Stock::with('item')
            ->where('item_id', '=', $item_id)
            ->where('operation_area_id', '=', $adjustment->operation_area_id)
            ->first();

        $adjustment->movements()->create([
            'item_id' => $item_id,
            'opening_qty' => $prevStockItem->quantity ?? 0,
            'qty_out' => $movement->adjustment_type == 'decrease' ? $movement->quantity : 0,
            'qty_in' => $movement->adjustment_type == 'increase' ? $movement->quantity : 0,
            'operation_area_id' => auth()->user()->operation_area,
            'type' => (new ReflectionClass(Adjustment::class))->getShortName(),
            'unit_price' => $movement->unit_price ?? 0,
            'vat' => $movement->vat ?? 0,
            'description' => "Adjustment of {$item->name} done  due to {$adjustment->description}  ",
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function extracted($user)
    {
        $query = Adjustment::with('operationArea');
        $query->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('operationArea', function ($query) use ($user) {
                $query->where('operator_id', $user->operator_id);
            });
        });
        $query->when($user->operation_area, function ($query) use ($user) {
            $query->where('operation_area_id', $user->operation_area);
        });

        return $query;
    }


    public function createNewAdjustment()
    {
        $user = auth()->user();


        $adjustmentId = \request('adjustment_id');
        if ($adjustmentId) {
            $adjustment = Adjustment::find(decryptId($adjustmentId));
        }elseif (session()->has('adjustment_id')) {
            $adjustment = Adjustment::find(session()->get('adjustment_id'));
        } else {
            $adjustment = new Adjustment();
        }
        if ($adjustment) {
            $adjustment->load(['items.item', 'flowHistories.user']);
                        $reviews = $adjustment->flowHistories
                ->where('is_comment', '=', true);

            $flowHistories = $adjustment->flowHistories
                ->where('is_comment', '=', false);
        }


        $items = Item::query()->with('category')->where('operator_id', $user->operator_id)->get();
        $stock = Stock::with('operationArea','item','item.category')
            ->where('operation_area_id', $user->operation_area)->get();
        $stock_data = $items->map(function ($item)use($user,$stock){
            $item->quantity = collect($stock)
                ->where('item_id', $item->id)
                ->where('operation_area_id', $user->operation_area)
                ->sum('quantity');
            return $item;
        });

        return view('admin.stock.adjustment.create_new', [
//            'adjustment_id' => $adjustmentId,
            'adjustment' => $adjustment,
            'reviews' => $reviews ?? null,
            'flowHistories' => $flowHistories ?? null,
            'stock' => $stock_data ?? null
        ]);
}
}
