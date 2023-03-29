<?php

namespace App\Exports;

use App\Models\RequestDurationConfiguration;
use Illuminate\Database\Eloquent\Builder;
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

        $startDate = request('start_date');
        $endDate = request('end_date');
        $operation_area_id = request('operation_area_id');
        $request_type_id = request('request_type_id');

        $data = RequestDurationConfiguration::with('requestType','operator','operationArea')

            ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                $builder->whereDate('created_at', '>=', $startDate);
            })
            ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                $builder->whereDate('created_at', '<=', $endDate);
            })
            ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                $builder->where('operation_area_id', $operation_area_id);
            })
            ->when(!empty($request_type_id), function (Builder $builder) use ($request_type_id) {
                $builder->where('request_type_id', $request_type_id);
            })
            ->get();
        return view('admin.settings.exports.request_duration_configuration', [
            'requestDurations' => $data
        ]);
    }
}
