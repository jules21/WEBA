<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\ValidateAddWaterNetwork;
use App\Http\Requests\ValidateReviewRequest;
use App\Http\Requests\ValidateStoreItemRequest;
use App\Models\Item;
use App\Models\PaymentDeclaration;
use App\Models\PaymentType;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use App\Models\StockMovementDetail;
use App\Notifications\PaymentNotification;
use Illuminate\Database\Eloquent\Collection;
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
        $previousStatus = $request->getPreviousStatus();
        // update request
        $this->updateRequest($request, $status);


        // save review
        $this->saveHistory($request, $data['comment'], $status);
        $this->saveHistory($request, "Request status marked as '$status'", $status, false);
        $this->takeDecision($status, $request);

        if ($status == Status::RETURN_BACK) {
            $request->update([
                'status' => $previousStatus,
                'return_back_status' => Status::RETURN_BACK
            ]);
        } elseif ($status != Status::REJECTED && $request->return_back_status == Status::RETURN_BACK) {
            $request->update([
                'return_back_status' => Status::RE_SUBMITTED
            ]);
        } else {
            $request->update([
                'return_back_status' => null
            ]);
        }

        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Review saved successfully');

    }

    public function saveHistory(AppRequest $request, $comment, $status, bool $is_comment = true): void
    {
        $request->flowHistories()->create([
            'comment' => $comment,
            'user_id' => auth()->id(),
            'is_comment' => $is_comment,
            'status' => $status,
            'type' => $request->getClassName(),
        ]);
    }

    public function updateRequest(AppRequest $request, $status): void
    {
        $request->update([
            'status' => $status,
            'approval_date' => $status == Status::APPROVED ? now() : null,
            'approved_by' => $status == Status::APPROVED ? auth()->user()->id : null,
        ]);
    }

    public function storeItem(ValidateStoreItemRequest $itemRequest, AppRequest $request)
    {
        $data = $itemRequest->validated();

        $item_id = $data['item_id'];
        $item = Item::query()->find($item_id);
        $id = $itemRequest->input('id');
        if ($id > 0) {
            $moveMovement = StockMovementDetail::query()->find($id);
            $model = $moveMovement->update([
                    'item_id' => $item_id,
                    'quantity' => $data['quantity'],
                    'unit_price' => $item->selling_price,
                    'type' => $request->getClassName(),
                    'status' => 'pending',
                ]
            );
        } else {
            $model = $request->items()
                ->create([
                    'item_id' => $item_id,
                    'quantity' => $data['quantity'],
                    'unit_price' => $item->selling_price,
                    'type' => $request->getClassName(),
                    'status' => 'pending',
                ]);
        }

        if ($itemRequest->ajax()) {
            return response()->json([
                'message' => 'Item saved successfully',
                'status' => 'success',
                'data' => $model,
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
                'status' => 'success',
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()
            ->back()
            ->with('success', 'Item deleted successfully');

    }

    /**
     * @throws Throwable
     */
    public function addWaterNetwork(ValidateAddWaterNetwork $request, AppRequest $req)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $paymentConfig = getPaymentConfiguration(PaymentType::CONNECTION_FEE, RequestType::NEW_CONNECTION);
        $req->update([
            'water_network_id' => $data['water_network_id'],
            'connection_fee' => $paymentConfig->amount,
        ]);

        DB::commit();
        session()->flash('success', 'Water network added successfully');
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Water network added successfully',
                'status' => 'success',
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()
            ->back()
            ->with('success', 'Water network added successfully');
    }

    public function declareMetersFee(AppRequest $request): void
    {
        $meters = $request->meterNumbers()->with('item')->get();
        $metersConfig = getPaymentConfiguration(PaymentType::METERS_FEE, $request->request_type_id);
        $sum = $meters->sum('item.selling_price');
        $dec = $request->paymentDeclarations()
            ->create([
                'amount' => $sum,
                'status' => PaymentDeclaration::ACTIVE,
                'payment_configuration_id' => $metersConfig->id,
                'type' => 'Meters Fee',
                'balance' => $sum,
                'payment_reference' => 'N/A',
            ]);
        $ref = $dec->generateReferenceNumber();
        $formatted = number_format($sum);
        $psp = $this->getPsp($metersConfig);
        $subscriptionNumbers = $request->meterNumbers->pluck('subscription_number')->implode(', ');
        $message = "You have to pay the meters fee of $formatted. Please use the reference number $ref to make the payment. You can pay via $psp. Subscription numbers of your meters are $subscriptionNumbers ";
        $request->customer->notify(new PaymentNotification($message));
    }

    public function declareMaterialsFee(Collection $requestItems, AppRequest $request): void
    {
        $sum = $requestItems->sum('total');
        $materialsConfig = getPaymentConfiguration(PaymentType::MATERIALS_FEE, $request->request_type_id);

        $dec = $request->paymentDeclarations()
            ->create([
                'amount' => $sum,
                'status' => PaymentDeclaration::ACTIVE,
                'payment_configuration_id' => $materialsConfig->id,
                'type' => 'Materials Fee',
                'balance' => $sum,
                'payment_reference' => 'N/A',
            ]);
        $ref = $dec->generateReferenceNumber();
        $formatted = number_format($sum);
        $psp = $this->getPsp($materialsConfig);
        $message = "You have to pay the materials fee of $formatted. Please use the reference number $ref to make the payment. You can pay via $psp";
        $request->customer->notify(new PaymentNotification($message));
    }

    public function declareConnectionFee(AppRequest $request): void
    {
        $connectionConfig = getPaymentConfiguration(PaymentType::CONNECTION_FEE, $request->request_type_id);
        $dec = $request->paymentDeclarations()
            ->create([
                'amount' => $request->connection_fee,
                'status' => PaymentDeclaration::ACTIVE,
                'payment_configuration_id' => $connectionConfig->id,
                'type' => 'Connection Fee',
                'balance' => $request->connection_fee,
                'payment_reference' => 'N/A',
            ]);
        $ref = $dec->generateReferenceNumber();
        $formatted = number_format($request->connection_fee);
        $psp = $this->getPsp($connectionConfig);
        $message = "You have to pay the connection fee of $formatted. Please use the reference number $ref to make the payment. You can pay via $psp.";
        $request->customer->notify(new PaymentNotification($message));
    }

    public function takeDecision($status, AppRequest $request): void
    {
        if ($status == Status::APPROVED) {
            if ($request->connection_fee > 0) {
                $this->declareConnectionFee($request);
            }
            $requestItems = $request->items()->with('item')->get();
            // save payment declarations for each item
            if ($requestItems->count() > 0) {
                $this->declareMaterialsFee($requestItems, $request);
            }

        } elseif ($status == Status::METER_ASSIGNED) {
            $request->load('meterNumbers.item');
            $this->declareMetersFee($request);
            $meters = $request->meterNumbers;
            // update stock movement details
            $meters->each(function ($meter) use ($request) {
                $request->items()
                    ->create([
                        'quantity' => 1,
                        'type' => $request->getClassName(),
                        'status' => 'pending',
                        'item_id' => $meter->item_id,
                        'unit_price' => $meter->item->selling_price,
                    ]);
            });

        }
    }
}
