<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillingResource;
use App\Http\Resources\MeterRequestResource;
use App\Models\Billing;
use App\Models\MeterRequest;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //

    public function recentRecords()
    {
        $user = auth()->user();
        $billings = Billing::query()
            ->with('meterRequest.request.customer')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'action' => 1,
            'message' => 'Billing Records',
            'data' => BillingResource::collection($billings)
        ]);
    }

    public function searchSubscriberNumber(Request $request)
    {
        $meterRequest = MeterRequest::where('subscription_number', $request->subscriptionNumber)
            ->first();
        if (!$meterRequest) {
            return response()->json([
                'action' => 0,
                'message' => 'Subscription Number not found',
                'data' => null
            ]);
        } else {
            $requestRecord = $meterRequest->request;
            if ($requestRecord->operator_id != auth()->user()->operator_id) {
                return response()->json([
                    'action' => 0,
                    'message' => 'Your are not authorized to view this record',
                    'data' => null
                ]);
            }

            $meterRequest->load('request.customer');
            return response()->json([
                'action' => 1,
                'message' => 'Subscription Number found',
                'data' => new MeterRequestResource($meterRequest)
            ]);
        }
    }

    public function storeBill(Request $request)
    {
        $meterRequest = MeterRequest::where('subscription_number', $request->subscriptionNumber)
            ->first();
        if (!$meterRequest) {
            return response()->json([
                'action' => 0,
                'message' => 'Subscription Number not found',
                'data' => null
            ]);
        }
        $exist = Billing::where('subscription_number', $request->subscription_number)
            ->orderBy('id', 'desc')
            ->first();
        if ($exist) {
            $starting_index = $exist->last_index;
        } else {
            $starting_index = $meterRequest->last_index;
        }
        $bill = new Billing();
        $bill->subscription_number = $request->subscriptionNumber;
        $bill->meter_number = $meterRequest->meter_number;
        $bill->last_index = $request->indexNumber;
        $bill->starting_index = $starting_index;
        $bill->user_id = auth()->user()->id;
        $bill->unit_price = 100;
        $bill->comment = $request->comment;
        $bill->amount = $bill->unit_price * ($bill->last_index - $bill->starting_index);
        $bill->balance = $bill->unit_price * ($bill->last_index - $bill->starting_index);
        $bill->save();
        $bill->load('meterRequest.request.customer');
        $meterRequest->update([
            'last_index' => $request->indexNumber,
            'balance' => $meterRequest->balance - $bill->amount,
        ]);
        return response()->json([
            'action' => 1,
            'message' => 'Bill created successfully',
            'data' => $bill
        ]);
    }

    public function meterUnpaidBills($subscriptionNumber)
    {
        $billings = Billing::query()
            ->with('meterRequest.request.customer')
            ->where('subscription_number', $subscriptionNumber)
            ->where('balance', '>', 0)
            ->orderBy('id')
            ->get();
        return response()->json([
            'action' => 1,
            'message' => 'Billing Records',
            'data' => BillingResource::collection($billings)
        ]);
    }
}
