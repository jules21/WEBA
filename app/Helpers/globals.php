<?php

use App\Models\PaymentConfiguration;

function getPaymentConfiguration($paymentTypeId, $requestTypeId, $operationAreaId = null): ?PaymentConfiguration
{
    return PaymentConfiguration::where('payment_type_id', '=', $paymentTypeId)
        ->where('request_type_id', '=', $requestTypeId)
        ->where('operation_area_id', '=', $operationAreaId ?? auth()->user()->operation_area)
        ->first();
}
