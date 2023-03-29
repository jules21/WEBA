<?php

namespace App\Exports;

use App\Models\BillCharge;
use App\Models\PaymentConfiguration;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentConfigurationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.payment_configurations', [
            'paymentConfigurations' => PaymentConfiguration::with('paymentType','requestType','operator','operationArea')->get()
        ]);
    }
}
