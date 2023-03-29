<?php

namespace App\Exports;

use App\Models\RequestDurationConfiguration;
use App\Models\WaterNetwork;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class WaterNetworksExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
        $operation_area_id = request('operation_area_id');
        $water_network_type_id = request('water_network_type_id');

        $data = WaterNetwork::with('waterNetworkType', 'waterNetworkStatus', 'operator', 'operationArea')
            ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                $builder->whereDate('created_at', '>=', $startDate);
            })
            ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                $builder->whereDate('created_at', '<=', $endDate);
            })
            ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                $builder->where('operation_area_id', $operation_area_id);
            })
            ->when(!empty($water_network_type_id), function (Builder $builder) use ($water_network_type_id) {
                $builder->where('water_network_type_id', $water_network_type_id);
            })
            ->get();
        return view('admin.settings.exports.water_networks', [
            'waterNetworks' => $data
        ]);
    }
}
