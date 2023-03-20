<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateDeliveryRequest;
use App\Models\MeterRequest;
use App\Models\Request as AppRequest;
use App\Models\RequestDelivery;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\StockMovementDetail;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class RequestDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws Exception
     */
    public function index(AppRequest $request)
    {
        if (\request()->ajax()) {
            $data = $request->deliveries()
                ->withSum('details', 'quantity')
                ->withCount(['details' => function (Builder $query) {
                    $query->where('quantity', '>', 0);
                }]);
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function (RequestDelivery $row) {
                    $count = $row->details_count;
                    $btn = '<a href="'.route('admin.requests.print-delivery',encryptId($row->id)).'"  data-toggle="tooltip" target="_blank"  data-id="' . $row->id . '"
                    data-original-title="Edit" class="edit btn btn-light-danger btn-sm editProduct"><i class="flaticon2-print"></i> Print</a>';
                    $btn = $btn . ' <a href="' . route('admin.requests.delivery.items', encryptId($row->id)) . '" data-toggle="tooltip"  data-id="' . $row->id . '"
                data-original-title="Delete" class="btn btn-light-primary btn-sm deleteProduct">
                   ' . $count . '
                    Items
                    </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $items = $request->items()
            ->with('item.category')
            ->whereDoesntHave('deliveryItems', function (Builder $builder) {
                $builder->where('remaining', '=', 0);
            })
            ->get();
        /*   $meterNumbers = $request->meterNumbers()
               ->with('item')
               ->whereDoesntHave('deliveryItems', function (Builder $builder) {
                   $builder->where('remaining', '=', 0);
               })
               ->get();*/

        return view('admin.requests.delivery.deliveries', [
            'request' => $request,
            'items' => $items,
//            'meterNumbers' => $meterNumbers
        ]);
    }


    /**
     * @throws Throwable
     */
    public function store(ValidateDeliveryRequest $deliveryRequest, AppRequest $request)
    {
        $data = $deliveryRequest->validated();

        DB::beginTransaction();
        $delivery = $request->deliveries()
            ->create([
                'batch_number' => $this->generateBatchNumber(),
                'done_by' => auth()->id(),
                'delivered_by_name' => $data['delivered_by_name'],
                'delivered_by_phone' => $data['delivered_by_phone'],
                'delivery_date' => now()
            ]);
        $items = $data['items'];
//        $meters = $data['meters'] ?? [];
        $quantities = $data['quantities'];
        foreach ($quantities as $key => $itemQty) {
//            if ($itemQty <= 0) continue;
            $requestItem = StockMovementDetail::find($items[$key]);
            $prevRemaining = $data['remaining_items'][$key];
            $delivery->details()->create([
                'quantity' => $itemQty,
                'remaining' => $prevRemaining - $itemQty,
                'stock_movement_detail_id' => $requestItem->id,
            ]);
            $this->updateStockMovement($requestItem, $request, $itemQty);
            $this->updateStock($requestItem->item_id, $requestItem->quantity);
        }

        /*     foreach ($meters as $meter) {
                 $requestItem = MeterRequest::find($meter);
                 $delivery->details()->create([
                     'meter_request_id' => $requestItem->id,
                     'meter_number' => $requestItem->meter_number,
                     'quantity' => 1,
                     'remaining' => 0,
                 ]);
                 $this->updateStockMovement($requestItem, $request, 1);
                 $this->updateStock($requestItem->item_id, 1);
             }*/

        // update request status if all items have no remaining

        $exists = $delivery->details()->where('remaining', '>', 0)->exists();
        if ($exists) {
            $request->update(['status' => AppRequest::PARTIALLY_DELIVERED]);
        } else {
            $request->update(['status' => AppRequest::DELIVERED]);
        }
        DB::commit();
        return redirect()->back()->with('success', 'Delivery created successfully');
    }


    /**
     * @param $item_id
     * @param $quantity
     * @return void
     */
    public function updateStock($item_id, $quantity): void
    {
        Stock::query()
            ->where([
                ['item_id', $item_id],
                ['operation_area_id', auth()->user()->operation_area]
            ])
            ->decrement('quantity', $quantity);
    }

    /**
     * @param $requestItem
     * @param AppRequest $request
     * @param $quantity
     * @return void
     */
    public function updateStockMovement($requestItem, AppRequest $request, $quantity): void
    {
        $item = $requestItem->item;
        $stockItem = $item->stock()->first();
        $item->stockMovements()
            ->create([
                'operation_area_id' => auth()->user()->operation_area,
                'opening_qty' => $stockItem->quantity ?? 0,
                'qty_in' => 0,
                'qty_out' => $quantity,
                'description' => 'Request approved, stock decreased by ' . $requestItem->quantity,
                'type' => StockMovement::Sale,
                'request_id' => $request->id,
            ]);
    }

    private function generateBatchNumber()
    {
        // unique batch number for each delivery request
        return 'DEL' . now()->format('Ymd') . rand(1000, 9999);
    }

    public function items($deliveryId)
    {
        $delivery = RequestDelivery::findOrFail(decryptId($deliveryId));
        $delivery->load(['details.requestItem.item', 'request']);
        $request = $delivery->request;
        return view('admin.requests.delivery.delivery_items', [
            'delivery' => $delivery,
            'request' => $request
        ]);
    }
    public function deliveryNote($deliveryId)
    {
        $delivery = RequestDelivery::findOrFail(decryptId($deliveryId));
        $delivery->load(['details.requestItem.item', 'request']);
        $request = $delivery->request;
        return view('admin.requests.delivery.item_delivery_note', [
            'delivery' => $delivery,
            'request' => $request
        ]);
    }
}
