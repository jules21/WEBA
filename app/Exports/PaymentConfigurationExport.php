<?php

namespace App\Exports;

use App\Models\BillCharge;
use App\Models\PaymentConfiguration;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentConfigurationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
        $operation_area_id = request('operation_area_id');
        $payment_type_id = request('payment_type_id');

        $data = PaymentConfiguration::with('paymentType','requestType','operator','operationArea')

            ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                $builder->whereDate('created_at', '>=', $startDate);
            })
            ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                $builder->whereDate('created_at', '<=', $endDate);
            })
            ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                $builder->where('operation_area_id', $operation_area_id);
            })
            ->when(!empty($payment_type_id), function (Builder $builder) use ($payment_type_id) {
                $builder->where('payment_type_id', $payment_type_id);
            })
            ->get();
        return view('admin.settings.exports.payment_configurations', [
            'paymentConfigurations' => $data
        ]);
    }
}
