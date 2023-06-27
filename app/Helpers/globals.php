<?php

use App\Constants\Permission;
use App\Constants\Status;
use App\Models\District;
use App\Models\Operator;
use App\Models\PaymentConfiguration;
use App\Models\Purchase;
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

function purchaseBuilder($fromCount = false)
{
    $startDate = \request('start_date');
    $endDate = \request('end_date');

    $user = auth()->user();
    return Purchase::query()
        ->with(['supplier', 'movementDetails.item.packagingUnit', 'movementDetails.item.stock.operationArea'])
//                ->where('operation_area_id', '=', auth()->user()->operation_area)
        ->withCount('movementDetails')
        ->where(function (Builder $builder) use ($fromCount) {
            if (request('type') == 'all' && $fromCount == false) {
                return;
            }
            $statuses = [];
            if (auth()->user()->can(Permission::StockInItems)) {
                $statuses[] = Status::RETURN_BACK;
            }
            if (auth()->user()->can(Permission::ApproveStockIn)) {
                $statuses[] = Status::SUBMITTED;
            }

            $builder->whereIn('status', $statuses);
        })
        ->when((request()->has('item_id') && request()->filled('item_id')), function ($query) {
            $query->whereHas('movementDetails', function ($query) {
                $query->where('item_id', '=', request()->item_id);
            });
        })
        ->when((request()->has('status') && request()->filled('status')), function ($query) {
            $query->where('status', '=', request()->status);
        })
        ->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('operationArea', function ($query) use ($user) {
                $query->where('operator_id', $user->operator_id);
            });
        })
        ->when($user->operation_area, function ($query) use ($user) {
            $query->where('operation_area_id', $user->operation_area);
        })
        ->when((request()->has('supplier_id') && request()->filled('supplier_id')), function ($query) {
            $query->where('supplier_id', '=', request()->supplier_id);
        })
        ->when((request()->has('from_date') && request()->filled('from_date')), function ($query) {
            $query->whereDate('created_at', '>=', request()->from_date);
        })
        ->when((request()->has('to_date') && request()->filled('to_date')), function ($query) {
            $query->whereDate('created_at', '<=', request()->to_date);
        })
        ->when(!is_null($startDate) && !is_null($endDate), function (Builder $query) use ($startDate, $endDate) {
            return $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        });
}

function badgesCounts(): array
{
    $pendingRequestsCount = pendingRequestsBuilder()->count();
    $myRequestsTasksCount = myTasksRequestBuilder()->count();
    $myTasksPurchasesCount = purchaseBuilder(true)->count();
    return [
        'pending_requests' => $pendingRequestsCount,
        'requests_tasks' => $myRequestsTasksCount,
        'purchases_tasks' => $myTasksPurchasesCount,
    ];
}


