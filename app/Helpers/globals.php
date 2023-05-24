<?php

use App\Constants\Permission;
use App\Models\District;
use App\Models\Operator;
use App\Models\PaymentConfiguration;
use Illuminate\Database\Eloquent\Builder;

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
        Permission::ManageChartOfAccounts,
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

function stockPermissions(): array
{
    return [Permission::ManageItemCategories, Permission::ManageItems, Permission::ManageStocks,
        Permission::ManageStockMovements, Permission::CreateAdjustment, Permission::ApproveAdjustment,
        Permission::ViewAdjustment, Permission::StockInItems, Permission::ApproveStockIn];
}

function isOperator(): bool
{
    return auth()->check() && auth()->user()->operator_id != null && auth()->user()->operation_area == null;
}

function isOperatorOrSuperAdmin(): bool
{
    return isOperator() || isSuperAdmin();
}

function isSuperAdmin(): bool
{
    return auth()->check() && auth()->user()->is_super_admin;
}

function isForOperationArea(): bool
{
    return auth()->check() && auth()->user()->operation_area;
}

function myOperators()
{
    return Operator::query()
        ->with('operationAreas')
        ->whereHas('customers', function (Builder $builder) {
            $builder->where('doc_number', '=', auth('client')->user()->doc_number);
        })
        ->limit(5)
        ->latest()
        ->get();
}

function getDistrictsToRequestConnection()
{
    return District::query()
        ->whereHas('operationAreas')
        ->orderBy('name')
        ->get();
}
