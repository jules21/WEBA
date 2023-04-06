<?php

namespace App\Http\Controllers;

use App\Models\PaymentConfiguration;
use App\Models\PaymentMapping;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getPsp(PaymentConfiguration $configuration)
    {
        $mappings = PaymentMapping::query()
            ->with('account.paymentServiceProvider')
            ->where('payment_configuration_id', '=', $configuration->id)
            ->get();

        $pspNames = [];
        foreach ($mappings as $mapping) {
            $psp = $mapping->account->paymentServiceProvider;
            $pspNames[] = $psp->name;
        }

        return implode(', ', $pspNames);
    }
}
