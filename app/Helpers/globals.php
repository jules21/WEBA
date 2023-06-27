<?php

use App\Constants\Permission;
use App\Constants\Status;
use App\Models\District;
use App\Models\Operator;
use App\Models\PaymentConfiguration;
use App\Models\Request as AppRequest;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\_IH_Request_QB;

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

function isNotOperator(): bool
{
    return !isOperator();
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

function issueManagementPermissions(): array
{
    return [
        Permission::ViewReportedIssues,
        Permission::ManageReportedIssues,
        Permission::CreateOperatorIssue,
        Permission::ManageOperatorIssues,
    ];
}

function isDistrict(): bool
{
    return auth()->check() && auth()->user()->district_id != null;
}


function settingsPermissions(): array
{
    return [Permission::ManageBanks, Permission::ManageBillCharges, Permission::ManageRequestType,
        Permission::ManagePaymentType, Permission::ManageDocumentTypes, Permission::ManagePackagingUnits,
        Permission::ManageRoadCrossTypes, Permission::ManageWaterUsages, Permission::ManageWaterNetworks,
        Permission::ManageWaterNetworkTypes, Permission::ManageWaterNetwork,
        Permission::ManageRequestDurationConfigurations, Permission::ManagePaymentConfigurations, Permission::ManageClusters];
}


/**
 * @return AppRequest|Builder|_IH_Request_QB
 */
function myTasksRequestBuilder()
{
    return AppRequest::query()
        ->with(['customer', 'requestType'])
        ->where([
            ['operation_area_id', '=', auth()->user()->operation_area],
        ])
        ->where(function (Builder $builder) {
            $hasPermission = false;
            $user = auth()->user();

            if ($user->can(Permission::ReviewRequest)) {
                $hasPermission = true;
                $builder
                    ->where('status', '=', Status::ASSIGNED)
                    ->whereHas('requestAssignment', fn(Builder $builder) => $builder->where('user_id', '=', auth()->id()));
            }
            if ($user->can(Permission::CreateRequest)) {
                $hasPermission = true;
                $builder->orWhere([
                    ['status', '=', Status::PENDING],
                    ['customer_initiated', '=', false]
                ]);
            }

            if ($user->can(Permission::ApproveRequest)) {
                $hasPermission = true;
                $builder->orWhere('status', '=', Status::PROPOSE_TO_APPROVE);
            }

            if ($user->can(Permission::AssignMeterNumber)) {
                $hasPermission = true;
                $builder->orWhere('status', '=', Status::APPROVED);
            }

            if ($hasPermission === false) {
                $builder->where('requests.id', '=', 0);
            }

        })
        ->whereHas('requestAssignment');
}

/**
 * @return AppRequest|Builder|_IH_Request_QB
 */
function pendingRequestsBuilder()
{
    return AppRequest::query()
        ->with(['customer', 'requestType'])
        ->where([
            ['operation_area_id', '=', auth()->user()->operation_area],
        ])
        ->whereDoesntHave('requestAssignments');
}

function badgesCounts(): array
{
    $pendingRequestsCount = pendingRequestsBuilder()->count();
    $myRequestsTasksCount = myTasksRequestBuilder()->count();
    return [
        'pending_requests' => $pendingRequestsCount,
        'my_tasks_requests' => $myRequestsTasksCount,
    ];
}


