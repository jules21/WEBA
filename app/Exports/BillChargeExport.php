<?php

namespace App\Exports;

use App\Models\BillCharge;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BillChargeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.bill_charges', [
            'bill_charges' => BillCharge::with('waterNetworkType','operationArea')->get()
        ]);
    }
}
