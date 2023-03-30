<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\PaymentConfiguration;
use App\Models\PaymentDeclaration;
use App\Models\PaymentHistory;
use App\Models\PaymentMapping;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function checkPayment(Request $request)
    {
        $referenceNumber = $request->paymentReference;
        $bankId = $request->bankId;
        //check if reference number contains CMS code
        if ($referenceNumber == null || $bankId == null) {
            return $this->errorResponse("Payment reference number or bank id is missing");
        }

        if (strpos($referenceNumber, 'CMS') !== false) {
            //check if reference number is valid
            $declaration = PaymentDeclaration::query()
                ->where("payment_reference", $referenceNumber)
                ->first();
            if ($declaration) {
                if($declaration->balance == 0){
                    return $this->errorResponse("Payment is already paid");
                }

                $paymentMapping = $this->getMapping($declaration, $bankId);
                if (!$paymentMapping) {
                    return $this->errorResponse("Payment is not allowed for this bank");
                }
                $data["rura_ref_no"] = $referenceNumber;
                $payment = $declaration->paymentConfig->paymentType->name;
                $data["payment_type"] = $payment;
                $data["license"] = $payment;
                $data["total_amount"] = $declaration->amount;
                $data["balance"] = $declaration->balance;
                $data["applicant"] = $declaration->request->customer->name;

                $data["issue_date"] = $declaration->created_at;
                $data["due_date"] = optional($declaration->created_at)->format('Y-m-d');
                $data=array_merge($data,  $this->getArr($paymentMapping, $data, false));
                return response()->json([
                    'response' => 'Payment paid successfully',
                    'responsecode' => 201,
                    'data' => $data,
                ], 201);
            } else {
                return $this->errorResponse("Payment reference not found");
            }

        } else {
            $billing = Billing::where('subscription_number', $referenceNumber)->first();
            if ($billing) {
                $meterRequest = $billing->meterRequest;
                list($paymentConfiguration, $paymentMapping) = $this->getBillPaymentMapping($meterRequest, $bankId);
                if (!$paymentMapping) {
                    return $this->errorResponse("Payment is not allowed for this bank");
                } else {
                    $totalAmount = Billing::query()
                        ->where('subscription_number', $referenceNumber)->sum('balance');
                    $data=[];
                    $data = $this->getArr($paymentMapping, $data);
                    $data["rura_ref_no"] = $referenceNumber;
                    $payment = $paymentConfiguration->paymentType->name;
                    $data["payment_type"] = $payment;
                    $data["license"] = $payment;
                    $data["total_amount"] = $totalAmount;
                    $data["balance"] = $totalAmount;
                    $data["applicant"] = $meterRequest->request->customer->name;

                    $data["issue_date"] = optional($billing->created_at)->format('Y-m-d');
                    $data["due_date"] = optional($billing->created_at)->format('Y-m-d');
                    $data=array_merge($data,  $this->getArr($paymentMapping, $data, false));
                    return response()->json([
                        'response' => 'Payment reference found',
                        'responsecode' => 201,
                        'data' => $data,
                    ], 201);
                }


            } else {
                return $this->errorResponse("Payment reference not found");
            }

        }
    }

    protected function errorResponse($message)
    {
        return response()->json([
            'response' => $message,
            'responsecode' => 400,
        ]);
    }


    public function confirmPayment(Request $request)
    {
        $referenceNumber = $request->rura_ref_no;
        $bank_txn_ref = $request->bank_txn_ref;
        $amount = $request->amount;
        $narration = $request->narration;
        $bankId = $request->bank_name;
        $paymentDate = $request->payment_date;

        if ($referenceNumber == null || $bank_txn_ref == null || $amount == null || $narration == null || $bankId == null) {
            return $this->errorResponse("Payment reference number or bank id is missing");
        }
        if ($amount <= 0) {
            return $this->errorResponse("Amount must be greater than zero");
        }

        if (strpos($referenceNumber, 'CMS') !== false) {
            $declaration = PaymentDeclaration::query()
                ->where("payment_reference", $referenceNumber)
                ->whereIn("status", [PaymentDeclaration::ACTIVE, PaymentDeclaration::PARTIALLY_PAID])
                ->first();
            if ($declaration) {
                if($declaration->balance < $amount){
                    return $this->errorResponse("Amount paid is greater than the balance");
                }
                $paymentMapping = $this->getMapping($declaration, $bankId);
                $history = new PaymentHistory();
                $history->payment_declaration_id = $declaration->id;
                $history->amount = $amount;
                $history->psp_reference_number = $bank_txn_ref;
                $history->narration = $narration;
                $history->payment_date=$paymentDate??now();
                $history->payment_mapping_id = $paymentMapping->id;
                $history->save();
                if ($declaration->balance == $amount) {
                    $declaration->status = PaymentDeclaration::PAID;
                    $declaration->balance = 0;
                } else {
                    $declaration->balance = $declaration->balance - $amount;
                    $declaration->status = PaymentDeclaration::PARTIALLY_PAID;
                }
                $declaration->save();
                return response()->json([
                    'response' => 'Payment paid successfully',
                    'responsecode' => 201,
                    'rura_id' => $referenceNumber,
                    'pay_ref' => $bank_txn_ref,
                ], 201);
            } else {
                return $this->errorResponse("Payment reference not found");
            }
        } else {
            $billing = Billing::where('subscription_number', $referenceNumber)->first();
            if ($billing) {
                $meterRequest = $billing->meterRequest;
                list($paymentConfiguration, $paymentMapping) = $this->getBillPaymentMapping($meterRequest, $bankId);
                $history = new Payment();
                $history->billing_id = $billing->id;
                $history->amount = $amount;
                $history->subscription_number = $referenceNumber;
                $history->bank_reference_number = $bank_txn_ref;
                $history->narration = $narration;
                $history->payment_mapping_id = $paymentMapping->id;
                $history->payment_date=$paymentDate??now();
                $history->save();
                $billing = Billing::where('subscription_number', $referenceNumber)
                    ->where("balance", '>', 0)->get();
                $meterRequest->update(['balance' => $meterRequest->balance + $amount]);
                foreach ($billing as $bill) {
                    $balance = $bill->balance;
                    $bill->balance = $bill->balance > $amount ? $bill->balance - $amount : 0;
                    $bill->update();
                    $amount = $amount - $balance;
                    if ($amount <= 0) {
                        break;
                    }
                }
                if($amount > 0){
                    $meterRequest->update(['balance' => $meterRequest->balance + $amount]);
                }
                return response()->json([
                    'response' => 'Payment paid successfully',
                    'responsecode' => 201,
                    'rura_id' => $referenceNumber,
                    'pay_ref' => $bank_txn_ref,
                ], 201);
            } else {
                return $this->errorResponse("Payment reference not found");
            }
        }
    }

    /**
     * @param $meterRequest
     * @param $bankId
     * @return array
     */
    public function getBillPaymentMapping($meterRequest, $bankId): array
    {
        $operatingArea = $meterRequest->request->operatingArea;
        $paymentConfiguration = PaymentConfiguration::query()
            ->where("operation_area_id", $operatingArea->id)
            ->where("payment_type_id", 4)
            ->where("is_active", 1)
            ->first();
        $paymentMapping = PaymentMapping::query()
            ->where("payment_configuration_id", $paymentConfiguration->id ?? 0)
            ->whereHas("account", function ($query) use ($bankId) {
                $query->whereHas("paymentServiceProvider", function ($query) use ($bankId) {
                    $query->where("clms_id", $bankId);
                });
            })->where("is_active", 1)->first();
        return array($paymentConfiguration, $paymentMapping);
    }

    /**
     * @param $declaration
     * @param $bankId
     * @return PaymentMapping|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getMapping($declaration, $bankId)
    {
        return PaymentMapping::query()
            ->where("payment_configuration_id", $declaration->payment_configuration_id)
            ->whereHas("account", function ($query) use ($bankId) {
                $query->whereHas("paymentServiceProvider", function ($query) use ($bankId) {
                    $query->where("clms_id", $bankId);
                });
            })->first();

    }

    /**
     * @param $paymentMapping
     * @param array $data
     * @return array
     */
    public function getArr(PaymentMapping $paymentMapping, array $data, $acceptPartial = true): array
    {
        $data["service_provider"] = $paymentMapping->account->paymentServiceProvider->name;
        $data["account_name"] = $paymentMapping->account->account_name;
        $data["account_number"] = $paymentMapping->account->account_number;
        $data["currency"] = "RWF";
        $data["status"] = "Active";
        $data["accept_partial"] = $acceptPartial;
        $data["payment_status"] = "PENDING";
        return $data;
    }

}
