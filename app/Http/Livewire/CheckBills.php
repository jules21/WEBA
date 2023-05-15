<?php

namespace App\Http\Livewire;

use App\Models\Billing;
use App\Models\PaymentDeclaration;
use Livewire\Component;

class CheckBills extends Component
{
    const WATER_BILL = 'Water Bill';
    const OTHER_BILL = 'Others';
    public string $billType = '';
    public $billNumber;
    public $paymentDetails;
    public $phone;

    public function render()
    {
        return view('livewire.check-bills')
            ->layoutData(['title' => 'Check Bills']);
    }


    public function fetchBillDetails()
    {
        // if bill number start with SN then it is a water bill
        if (substr(strtoupper($this->billNumber), 0, 2) == 'SN') {
            $this->billType = self::WATER_BILL;
            $this->paymentDetails = $this->getWaterBills();
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
            $newPaymentDetails = $this->getWaterBills();
            if ($newPaymentDetails->balance > 0) {
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

    /**
     * @return Billing|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_Billing_QB|object|null
     */
    public function getWaterBills()
    {
        return Billing::query()
            ->where('subscription_number', '=', $this->billNumber)
            ->orderByDesc('id')
            ->first();
    }

    /**
     * @return PaymentDeclaration|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getOtherBills()
    {
        return PaymentDeclaration::query()
            ->where('payment_reference', '=', $this->billNumber)
            ->first();
    }
}
