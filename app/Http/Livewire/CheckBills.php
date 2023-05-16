<?php

namespace App\Http\Livewire;

use App\Models\Billing;
use App\Models\BillingSummary;
use App\Models\PaymentDeclaration;
use Livewire\Component;

class CheckBills extends Component
{
    const WATER_BILL = 'Water Bill';
    const OTHER_BILL = 'Others';
    public string $billType = '';
    public $billNumber;
    public $paymentDetails;
    private ?BillingSummary $billingSummary = null;
    public $phone;

    public function render()
    {
        return view('livewire.check-bills', [
            'billingSummary' => $this->billingSummary,
            'paymentDetails' => $this->paymentDetails
        ])
            ->layoutData(['title' => 'Check Bills']);
    }


    public function fetchBillDetails()
    {
        // if bill number start with SN then it is a water bill
        if (substr(strtoupper($this->billNumber), 0, 2) == 'SN') {
            $this->billType = self::WATER_BILL;
            $this->billingSummary = $this->getWaterBills();
//            dd($this->billingSummary);
        } else {
            $this->billType = self::OTHER_BILL;
            $this->paymentDetails = $this->getOtherBills();
        }
    }

    public function payBill()
    {
        $this->validate([
            'phone' => 'required',
            'billNumber' => 'required',
        ]);


        if ($this->billType == self::WATER_BILL) {
            $billingSummary = $this->getWaterBills();
            if ($billingSummary->total_balance_due > 0) {
                $this->payWaterBill();
            } else {
                session()->flash('error', "You have no pending bills please try again later");
                return;
            }
        } else {
            $newPaymentDetails = $this->getOtherBills();
            if (strtolower($newPaymentDetails->status) == PaymentDeclaration::ACTIVE) {
                $this->payOtherBill();
            } else {
                session()->flash('error', "You have no pending payment please try again later");
                return;
            }
            $this->payOtherBill();
        }
        session()->flash('success', "Payment initiated ,please use your phone to approve a payment");
        $this->reset();
    }

    private function payWaterBill()
    {

    }

    private function payOtherBill()
    {

    }


    public function getWaterBills(): ?BillingSummary
    {
        $billNumber = $this->billNumber;
        $billings = Billing::with('meterRequest.request.customer')
            ->where('subscription_number', '=', $billNumber)
            ->get();

        if ($billings->isEmpty())
            return null;

        $customer_name = $billings->first()->meterRequest->request->customer->name;
        $total_balance_due = Billing::where('subscription_number', $billNumber)
            ->sum('balance');
        $total_amount_paid = Billing::where('subscription_number', $billNumber)
                ->sum('amount') - $total_balance_due;

        return new BillingSummary($customer_name, $billNumber, $total_balance_due, $total_amount_paid);

    }


    public function getOtherBills()
    {
        return PaymentDeclaration::query()
            ->where('payment_reference', '=', $this->billNumber)
            ->first();
    }
}
