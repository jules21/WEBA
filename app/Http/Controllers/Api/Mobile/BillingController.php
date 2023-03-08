<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\MeterRequest;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //

    public function recentRecords()
    {
        $user = auth()->user();
        $billing = Billing::query()
            ->with('meterRequest.request.customer')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'action' => 1,
            'message' => 'Billing Records',
            'data' => $billing
        ]);
    }

    public function searchSubscriberNumber(Request $request)
    {
        $meterRequest = MeterRequest::where('subscription_number', $request->subscription_number)
            ->first();
        if (!$meterRequest) {
            return response()->json([
                'action' => 0,
                'message' => 'Subscription Number not found',
                'data' => null
            ]);
        } else {
            $meterRequest->load('request.customer');
            return response()->json([
                'action' => 1,
                'message' => 'Subscription Number found',
                'data' => $meterRequest
            ]);
        }
    }

    public function storeBill(Request $request)
    {
        $meterRequest = MeterRequest::where('subscription_number', $request->subscription_number)
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
        $bill->subscription_number = $request->subscription_number;
        $bill->meter_number = $meterRequest->meter_number;
        $bill->last_index = $request->index_number;
        $bill->starting_index = $starting_index;
        $bill->user_id = auth()->user()->id;
        $bill->unit_price = 100;
        $bill->save();
        $bill->update([
            'amount' => $bill->unit_price * ($bill->last_index - $bill->starting_index),
            'balance' => $bill->unit_price * ($bill->last_index - $bill->starting_index)
        ]);
        $bill->load('meterRequest.request.customer');
        $meterRequest->update([
            'last_index' => $request->index_number,
            'balance' => $meterRequest->balance - $bill->amount,
        ]);
        return response()->json([
            'action' => 1,
            'message' => 'Bill created',
            'data' => $bill
        ]);


    }
}
