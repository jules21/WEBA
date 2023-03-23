<?php

use App\Constants\Permission;
use App\Models\PaymentConfiguration;

function getPaymentConfiguration($paymentTypeId, $requestTypeId, $operationAreaId = null): ?PaymentConfiguration
{
    return PaymentConfiguration::where('payment_type_id', '=', $paymentTypeId)
        ->where('request_type_id', '=', $requestTypeId)
        ->where('operation_area_id', '=', $operationAreaId ?? auth()->user()->operation_area)
        ->first();
}


function accountingPermissions(): array
{
    return [
        Permission::ManageExpenses,
        Permission::ManageCashMovements,
        Permission::ManageJournalEntries,
        Permission::ViewGeneralLedger,
        Permission::ViewLedgerBalance,
    ];
}

function accountingSettingsPermissions(): array
{
    return [
        Permission::AssignChartOfAccounts,
        Permission::ManageLedgerMigration,
        Permission::ManageChartOfAccounts
    ];
}

function accountingAllPermissions(): array
{
    return array_merge(accountingPermissions(), accountingSettingsPermissions());
}

function requestPermissions(): array
{
    return [Permission::CreateRequest, Permission::ApproveRequest, Permission::AssignMeterNumber, Permission::ReviewRequest];
}
