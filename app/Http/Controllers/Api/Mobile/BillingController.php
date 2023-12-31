<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillingResource;
use App\Http\Resources\MeterRequestResource;
use App\Models\BillCharge;
use App\Models\Billing;
use App\Models\MeterRequest;
use App\Models\Payment;
use App\Models\WaterNetworkType;
use App\Notifications\SmsMailNotification;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //
    use UploadFileTrait;

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
            'data' => BillingResource::collection($billings),
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
                'data' => null,
            ]);
        } else {
//            $requestRecord = $meterRequest->request;
//            if ($requestRecord->operator_id != auth()->user()->operator_id) {
//                return response()->json([
//                    'action' => 0,
//                    'message' => 'Your are not authorized to view this record',
//                    'data' => null,
//                ]);
//            }

            $meterRequest->load('request.customer');

            return response()->json([
                'action' => 1,
                'message' => 'Subscription Number found',
                'data' => new MeterRequestResource($meterRequest),
            ]);
        }
    }

    public function storeBill(Request $request)
    {
        $user = auth()->user();
        if ($user->can('Make Billing')) {
            $meterRequest = MeterRequest::where('subscription_number', $request->subscriptionNumber)
                ->first();
            if (!$meterRequest) {
                return response()->json([
                    'action' => 0,
                    'message' => 'Subscription Number not found',
                    'data' => null,
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

            $billingAmount = WaterNetworkType::query()
                ->find($meterRequest->request->waterNetwork->water_network_type_id)->unit_price;
            if (!$billingAmount) {
                return response()->json([
                    'action' => 0,
                    'message' => 'No charge found,Please contact admin',
                    'data' => null,
                ]);
            }
            $bill = new Billing();
            if ($request->hasFile('meterImage')) {
                //convert image from base64 to file and save it to storage
                $bill->attachment = $this->uploadFile($request->meterImage, 'public/meter_images');
            }
            $bill->subscription_number = $request->subscriptionNumber;
            $bill->meter_number = $meterRequest->meter_number;
            $bill->last_index = $request->indexNumber;
            $bill->starting_index = $starting_index;
            $bill->user_id = auth()->user()->id;
            $bill->unit_price = $billingAmount;
            $bill->comment = $request->comment;
            $bill->amount = $bill->unit_price * ($bill->last_index - $bill->starting_index);
            $bill->balance = $bill->unit_price * ($bill->last_index - $bill->starting_index);
            $bill->save();
            $bill->load('meterRequest.request.customer');
            $message = 'Dear ' . $meterRequest->request->customer->name . ', Your bill for the month of ' . date('F') . ' is ' . $bill->amount . ' RWF. Please pay before ' . date('d-m-Y', strtotime('+30 days')) . ' to avoid disconnection. Thank you.';
            $meterRequest->request->customer->notify(new SmsMailNotification($message));

            //if meter request balance is greater than 0,make payment of the bill
            if ($meterRequest->balance > 0) {
                $billings = Billing::where('subscription_number', $request->subscriptionNumber)
                    ->where('balance', '>', 0)->orderBy("created_at")->get();
                $amount = min($bill->amount, $meterRequest->balance);

                foreach ($billings as $bil) {
                    $balance = $bill->balance;
                    $bil->balance = $balance > $amount ? $balance - $amount : 0;
                    $bil->update();
                    $history = new Payment();
                    $history->billing_id = $bil->id;
                    $history->amount = min($balance, $amount);
                    $history->subscription_number = $request->subscriptionNumber;
                    $history->bank_reference_number = str_random(10);
                    $history->narration = 'Automatic bill Payment  of ' . $bil->amount . ' RWF';
                    $history->payment_date = now();
                    $history->source = 'Balance';
                    $history->save();
                    $amount = $amount - $balance;
                    if ($amount <= 0) {
                        break;
                    }
                }
            }
            $meterRequest->update([
                'last_index' => $request->indexNumber,
                'balance' => $meterRequest->balance - $bill->amount,
            ]);


            return response()->json([
                'action' => 1,
                'message' => 'Bill created successfully',
                'data' => $bill,
            ]);
        } else {
            return response()->json([
                'action' => 0,
                'message' => 'You are not authorized to make billing',
                'data' => null,
            ]);
        }
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
            'data' => BillingResource::collection($billings),
        ]);
    }
}
