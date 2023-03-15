<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAddWaterNetwork;
use App\Http\Requests\ValidateReviewRequest;
use App\Http\Requests\ValidateStoreItemRequest;
use App\Models\PaymentConfiguration;
use App\Models\PaymentDeclaration;
use App\Models\PaymentType;
use App\Models\Request as AppRequest;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\StockMovementDetail;
use App\Notifications\PaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class RequestReviewController extends Controller
{
    /**
     * @throws Throwable
     */
    public function saveReview(ValidateReviewRequest $reviewRequest, AppRequest $request)
    {
        $data = $reviewRequest->validated();

        DB::beginTransaction();

        $status = $data['status'];

        // update request
        $this->updateRequest($request, $status);
        // save review
        $this->saveHistory($request, $data['comment'], $status);
        $this->saveHistory($request, "Request status marked as '$status'", $status, false);

        if ($status == AppRequest::APPROVED) {

            if ($request->connection_fee > 0) {
                $connectionConfig = getPaymentConfiguration(PaymentType::CONNECTION_FEE, $request->request_type_id);
                $dec = $request->paymentDeclarations()
                    ->create([
                        'amount' => $request->connection_fee,
                        'status' => PaymentDeclaration::ACTIVE,
                        'payment_configuration_id' => $connectionConfig->id,
                        'type' => "Connection Fee",
                        'balance' => $request->connection_fee,
                        'payment_reference' => 'N/A'
                    ]);
                $ref = $dec->generateReferenceNumber();
                $formatted = number_format($request->connection_fee, 0);
                $message = "You have to pay the connection fee of $formatted. Please use the reference number $ref to make the payment.";
                $request->customer->notify(new PaymentNotification($message));
            }

            $requestItems = $request->items()->with('item')->get();
            // save payment declarations for each item
            if ($requestItems->count() > 0) {
                $sum = $requestItems->sum('total');
                $materialsConfig = getPaymentConfiguration(PaymentType::MATERIALS_FEE, $request->request_type_id);

                $dec = $request->paymentDeclarations()
                    ->create([
                        'amount' => $sum,
                        'status' => PaymentDeclaration::ACTIVE,
                        'payment_configuration_id' => $materialsConfig->id,
                        'type' => "Materials Fee",
                        'balance' => $sum,
                        'payment_reference' => 'N/A'
                    ]);
                $ref = $dec->generateReferenceNumber();
                $formatted = number_format($sum, 0);
                $message = "You have to pay the materials fee of $formatted. Please use the reference number $ref to make the payment.";
                $request->customer->notify(new PaymentNotification($message));

            }


      /*      foreach ($requestItems as $requestItem) {
                $this->updateStockMovement($requestItem, $request);
                $this->updateStock($requestItem);
            }*/

            $request->operator
                ->customers()
                ->syncWithoutDetaching([
                    $request->customer_id
                ]);
        }


        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Review saved successfully');

    }

    /**
     * @param AppRequest $request
     * @param $comment
     * @param $status
     * @return void
     */
    public function saveHistory(AppRequest $request, $comment, $status, $is_comment = true): void
    {
        $request->flowHistories()->create([
            'comment' => $comment,
            'user_id' => auth()->id(),
            'is_comment' => $is_comment,
            'status' => $status,
            'type' => $request->getClassName()
        ]);
    }

    /**
     * @param AppRequest $request
     * @param $status
     * @return void
     */
    public function updateRequest(AppRequest $request, $status): void
    {
        $request->update([
            'status' => $status,
            'approval_date' => $status == AppRequest::APPROVED ? now() : null,
            'approved_by' => $status == AppRequest::APPROVED ? auth()->user()->id : null,
        ]);
    }

    public function storeItem(ValidateStoreItemRequest $itemRequest, AppRequest $request)
    {

        $data = $itemRequest->validated();

        $item = $request->items()
            ->updateOrCreate(
                ['item_id' => $data['item_id']],
                [
                    'quantity' => $data['quantity'],
                    'unit_price' => $data['unit_price'],
                    'type' => $request->getClassName(),
                    'status' => 'pending'
                ]
            );


        if ($itemRequest->ajax()) {
            return response()->json([
                'message' => 'Item saved successfully',
                'status' => 'success',
                'data' => $item
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()->back()
            ->with('success', 'Item saved successfully');

    }

    /**
     * @throws Throwable
     */
    public function deleteRequestItem(AppRequest $request, $id)
    {
        $id = decryptId($id);
        StockMovementDetail::query()->find($id)->delete();

        if (\request()->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully',
                'status' => 'success'
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()
            ->back()
            ->with('success', 'Item deleted successfully');

    }

    /**
     * @param $requestItem
     * @return void
     */
    public function updateStock($requestItem): void
    {
        Stock::query()
            ->where([
                ['item_id', $requestItem->item_id],
                ['operation_area_id', auth()->user()->operation_area]
            ])
            ->decrement('quantity', $requestItem->quantity);
    }

    /**
     * @param $requestItem
     * @param AppRequest $request
     * @return void
     */
    public function updateStockMovement($requestItem, AppRequest $request): void
    {
        $item = $requestItem->item;
        $stockItem = $item->stock()->first();
        $item->stockMovements()
            ->create([
                'operation_area_id' => auth()->user()->operation_area,
                'opening_qty' => $stockItem->quantity,
                'qty_in' => 0,
                'qty_out' => $requestItem->quantity,
                'description' => 'Request approved, stock decreased by ' . $requestItem->quantity,
                'type' => StockMovement::Sale,
                'request_id' => $request->id,
            ]);
    }

    /**
     * @throws Throwable
     */
    public function addWaterNetwork(ValidateAddWaterNetwork $request, AppRequest $req)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $req->update([
            'water_network_id' => $data['water_network_id'],
            'connection_fee' => $data['connection_fee'],
        ]);

        DB::commit();
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Water network added successfully',
                'status' => 'success'
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()
            ->back()
            ->with('success', 'Water network added successfully');
    }
}
