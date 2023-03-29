<?php

namespace App\Exports;

use App\Models\RequestDurationConfiguration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RequestDurationConfigurationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.request_duration_configuration', [
            'requestDurations' => RequestDurationConfiguration::with('requestType','operator','operationArea')->get()
        ]);
    }
}
