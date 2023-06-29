<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Adjustment
 *
 * @property int $id
 * @property string $status Pending,Approved
 * @property string $description
 * @property int $operation_area_id
 * @property int $created_by
 * @property int|null $approved_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Adjustment newModelQuery()
 * @method static Builder|Adjustment newQuery()
 * @method static Builder|Adjustment query()
 * @method static Builder|Adjustment whereApprovedBy($value)
 * @method static Builder|Adjustment whereCreatedAt($value)
 * @method static Builder|Adjustment whereCreatedBy($value)
 * @method static Builder|Adjustment whereDescription($value)
 * @method static Builder|Adjustment whereId($value)
 * @method static Builder|Adjustment whereOperationAreaId($value)
 * @method static Builder|Adjustment whereStatus($value)
 * @method static Builder|Adjustment whereUpdatedAt($value)
 * @property-read Collection<int, FlowHistory> $flowHistories
 * @property-read int|null $flow_histories_count
 * @property-read Collection<int, StockMovementDetail> $items
 * @property-read int|null $items_count
 * @property-read Collection<int, StockMovement> $movements
 * @property-read int|null $movements_count
 * @property-read OperationArea $operationArea
 * @property string|null $attachment
 * @property string|null $return_back_status
 * @property-read User|null $approvedBy
 * @property-read Collection<int, Audit> $audits
 * @property-read int|null $audits_count
 * @property-read User $createdBy
 * @property-read string $id_encrypted
 * @property-read string $status_color
 * @property-read Collection<int, StockMovementDetail> $movementDetails
 * @property-read int|null $movement_details_count
 * @method static Builder|Adjustment whereAttachment($value)
 * @method static Builder|Adjustment whereReturnBackStatus($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $items
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $movementDetails
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $movements
 * @method static \Database\Factories\AdjustmentFactory factory(...$parameters)
 */
	class Adjustment extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\BillCharge
 *
 * @property int $id
 * @property int $water_network_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $operation_area_id
 * @property string $unit_price
 * @method static \Database\Factories\BillChargeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereWaterNetworkTypeId($value)
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\WaterNetworkType $waterNetworkType
 * @property int|null $operator_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Operator|null $operator
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereOperatorId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 */
	class BillCharge extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Billing
 *
 * @property int $id
 * @property string $starting_index
 * @property string $last_index
 * @property int $user_id
 * @property string $unit_price
 * @property string $meter_number
 * @property string $subscription_number
 * @property string $amount
 * @property string $balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Billing newModelQuery()
 * @method static Builder|Billing newQuery()
 * @method static Builder|Billing query()
 * @method static Builder|Billing whereAmount($value)
 * @method static Builder|Billing whereBalance($value)
 * @method static Builder|Billing whereCreatedAt($value)
 * @method static Builder|Billing whereId($value)
 * @method static Builder|Billing whereLastIndex($value)
 * @method static Builder|Billing whereMeterNumber($value)
 * @method static Builder|Billing whereStartingIndex($value)
 * @method static Builder|Billing whereSubscriptionNumber($value)
 * @method static Builder|Billing whereUnitPrice($value)
 * @method static Builder|Billing whereUpdatedAt($value)
 * @method static Builder|Billing whereUserId($value)
 * @property string|null $comment
 * @property string|null $attachment
 * @property-read MeterRequest|null $meterRequest
 * @property-read User $user
 * @method static Builder|Billing whereAttachment($value)
 * @method static Builder|Billing whereComment($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $amount_paid
 * @property-read mixed $cubic_meters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $history
 * @property-read int|null $history_count
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $history
 */
	class Billing extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CashMovement
 *
 * @property int $id
 * @property string $date
 * @property string $transaction_type
 * @property int $psp_id
 * @property int $psp_account_id
 * @property int $source_ledger
 * @property int $destination_ledger
 * @property int|null $currency_id
 * @property string $amount
 * @property string $description
 * @property string|null $reference_no
 * @property int $operation_area_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CashMovement newModelQuery()
 * @method static Builder|CashMovement newQuery()
 * @method static Builder|CashMovement query()
 * @method static Builder|CashMovement whereAmount($value)
 * @method static Builder|CashMovement whereCreatedAt($value)
 * @method static Builder|CashMovement whereCurrencyId($value)
 * @method static Builder|CashMovement whereDate($value)
 * @method static Builder|CashMovement whereDescription($value)
 * @method static Builder|CashMovement whereDestinationLedger($value)
 * @method static Builder|CashMovement whereId($value)
 * @method static Builder|CashMovement whereOperationAreaId($value)
 * @method static Builder|CashMovement wherePspAccountId($value)
 * @method static Builder|CashMovement wherePspId($value)
 * @method static Builder|CashMovement whereReferenceNo($value)
 * @method static Builder|CashMovement whereSourceLedger($value)
 * @method static Builder|CashMovement whereTransactionType($value)
 * @method static Builder|CashMovement whereUpdatedAt($value)
 * @method static Builder|CashMovement whereUserId($value)
 * @property-read \App\Models\PaymentServiceProvider|null $paymentServiceProvider
 * @property-read \App\Models\PaymentServiceProviderAccount|null $paymentServiceProviderAccount
 * @mixin Eloquent
 */
	class CashMovement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cell
 *
 * @property int $id
 * @property string $name
 * @property int $sector_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Village> $villages
 * @property-read int|null $villages_count
 * @method static \Database\Factories\CellFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cell newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cell newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cell query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cell whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cell whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cell whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cell whereSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cell whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Village> $villages
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Village> $villages
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Village> $villages
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Village> $villages
 * @mixin \Eloquent
 * @property-read \App\Models\Sector $sector
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Village> $villages
 */
	class Cell extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChartAccount
 *
 * @property int $id
 * @property int $operation_area_id
 * @property int $ledger_no
 * @property string $ledger_description
 * @property string $ledger_type
 * @property int|null $parent_ledger_no
 * @property int $level
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 * @property-read int|null $children_count
 * @property-read ChartAccount|null $parent
 * @method static \Database\Factories\ChartAccountFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLedgerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLedgerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereParentLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 */
	class ChartAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChartAccountTemplate
 *
 * @property int $id
 * @property int $ledger_no
 * @property string $ledger_description
 * @property string $ledger_type
 * @property int|null $parent_ledger_no
 * @property int $level
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ChartAccountTemplateFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLedgerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLedgerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereParentLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ChartAccountTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property int $legal_type_id
 * @property int $document_type_id
 * @property string $doc_number
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $password
 * @property int $province_id
 * @property int $district_id
 * @property int $sector_id
 * @property int $cell_id
 * @property int|null $village_id
 * @property string|null $otp
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cell $cell
 * @property-read \App\Models\District $district
 * @property-read \App\Models\DocumentType $documentType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReportDetail> $issueDetails
 * @property-read int|null $issue_details_count
 * @property-read \App\Models\LegalType $legalType
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Province $province
 * @property-read \App\Models\Sector $sector
 * @property-read \App\Models\Village|null $village
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCellId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDocNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLegalTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereVillageId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReportDetail> $issueDetails
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cluster
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $expiration_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $district_id
 * @property-read \App\Models\District|null $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sector> $sectors
 * @property-read int|null $sectors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WaterNetwork> $waterNetworks
 * @property-read int|null $water_networks_count
 * @method static \Database\Factories\ClusterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cluster whereUpdatedAt($value)
 */
	class Cluster extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contract
 *
 * @property int $id
 * @property int|null $operation_area_id
 * @property bool $status
 * @property string $start_date
 * @property string $end_date
 * @property string $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $contract_url
 * @property-read \App\Models\OperationArea|null $operationArea
 * @method static \Database\Factories\ContractFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 */
	class Contract extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $symbol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CurrencyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CurrencyOperator
 *
 * @property int $id
 * @property int $operation_area_id
 * @property string $code
 * @property string $name
 * @property string|null $symbol
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CurrencyOperatorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator query()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CurrencyOperator extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property int $legal_type_id
 * @property string $doc_number
 * @property string|null $email
 * @property string $phone
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $sector_id
 * @property int|null $cell_id
 * @property int|null $village_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $document_type_id
 * @property-read DocumentType $documentType
 * @property-read LegalType $legalType
 * @method static CustomerFactory factory(...$parameters)
 * @method static Builder|Customer newModelQuery()
 * @method static Builder|Customer newQuery()
 * @method static Builder|Customer query()
 * @method static Builder|Customer whereCellId($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereDistrictId($value)
 * @method static Builder|Customer whereDocNumber($value)
 * @method static Builder|Customer whereDocumentTypeId($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereLegalTypeId($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer wherePhone($value)
 * @method static Builder|Customer whereProvinceId($value)
 * @method static Builder|Customer whereSectorId($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 * @method static Builder|Customer whereVillageId($value)
 * @property-read Cell|null $cell
 * @property-read Collection<int, MeterRequest> $connections
 * @property-read int|null $connections_count
 * @property-read District|null $district
 * @property-read string $address
 * @property-read Collection<int, Operator> $operators
 * @property-read int|null $operators_count
 * @property-read Province|null $province
 * @property-read Collection<int, Request> $requests
 * @property-read int|null $requests_count
 * @property-read Sector|null $sector
 * @property-read Village|null $village
 * @property int|null $operator_id
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read OperationArea $operationArea
 * @property-read Operator|null $operator
 * @method static Builder|Customer whereOperatorId($value)
 * @property-read Collection<int, Audit> $audits
 * @property-read int|null $audits_count
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MeterRequest> $connections
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Request> $requests
 */
	class Customer extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\CustomerOperator
 *
 * @property int $id
 * @property int $customer_id
 * @property int $operator_id
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator whereOperatorId($value)
 * @mixin \Eloquent
 */
	class CustomerOperator extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id
 * @property string $name
 * @property int $province_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sector> $sectors
 * @property-read int|null $sectors_count
 * @method static \Database\Factories\DistrictFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OperationArea> $operationAreas
 * @property-read int|null $operation_areas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sector> $sectors
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OperationArea> $operationAreas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sector> $sectors
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OperationArea> $operationAreas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sector> $sectors
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DocumentType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DocumentTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class DocumentType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expense
 *
 * @property int $id
 * @property int $operation_area_id
 * @property string $date
 * @property string $amount
 * @property string $description
 * @property int $expense_ledger
 * @property int $expense_category
 * @property int $payment_ledger
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Expense newModelQuery()
 * @method static Builder|Expense newQuery()
 * @method static Builder|Expense query()
 * @method static Builder|Expense whereAmount($value)
 * @method static Builder|Expense whereCreatedAt($value)
 * @method static Builder|Expense whereDate($value)
 * @method static Builder|Expense whereDescription($value)
 * @method static Builder|Expense whereExpenseCategory($value)
 * @method static Builder|Expense whereExpenseLedger($value)
 * @method static Builder|Expense whereId($value)
 * @method static Builder|Expense whereOperationAreaId($value)
 * @method static Builder|Expense wherePaymentLedger($value)
 * @method static Builder|Expense whereUpdatedAt($value)
 * @method static Builder|Expense whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ChartAccount $expenseCategory
 * @property-read \App\Models\ChartAccount $expenseLedger
 * @property-read \App\Models\ChartAccount $paymentLedger
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 */
	class Expense extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Faq
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\FaqFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FlowHistory
 *
 * @property int $id
 * @property int $model_id
 * @property string $model_type
 * @property string|null $comment
 * @property string $status
 * @property string $type
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $model
 * @method static Builder|FlowHistory newModelQuery()
 * @method static Builder|FlowHistory newQuery()
 * @method static Builder|FlowHistory query()
 * @method static Builder|FlowHistory whereComment($value)
 * @method static Builder|FlowHistory whereCreatedAt($value)
 * @method static Builder|FlowHistory whereId($value)
 * @method static Builder|FlowHistory whereModelId($value)
 * @method static Builder|FlowHistory whereModelType($value)
 * @method static Builder|FlowHistory whereStatus($value)
 * @method static Builder|FlowHistory whereType($value)
 * @method static Builder|FlowHistory whereUpdatedAt($value)
 * @method static Builder|FlowHistory whereUserId($value)
 * @property bool $is_comment
 * @property-read string $status_color
 * @property-read User $user
 * @method static Builder|FlowHistory whereIsComment($value)
 * @property string|null $attachment
 * @property-read mixed $attachment_url
 * @method static Builder|FlowHistory whereAttachment($value)
 * @mixin Eloquent
 */
	class FlowHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GracePeriod
 *
 * @property int $id
 * @property int $days
 * @property string $status
 * @property int|null $operation_area_id
 * @property int|null $contract_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\GracePeriodFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GracePeriod whereUpdatedAt($value)
 */
	class GracePeriod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Institution
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\InstitutionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution query()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUpdatedAt($value)
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUserId($value)
 * @mixin \Eloquent
 */
	class Institution extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IssueReport
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property int|null $client_id
 * @property int|null $operation_area_id
 * @property int|null $user_id
 * @property int|null $district_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReportDetail> $details
 * @property-read int|null $details_count
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereUserId($value)
 * @mixin \Eloquent
 * @property int $operator_id
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReportDetail> $details
 * @property-read string $status_color
 * @property-read \App\Models\OperationArea|null $operatingArea
 * @property-read \App\Models\Operator $operator
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReport whereOperatorId($value)
 */
	class IssueReport extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IssueReportDetail
 *
 * @property int $id
 * @property int $issue_report_id
 * @property int $user_id
 * @property string $user_type
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IssueReport $issueReport
 * @property-read Model|Eloquent $user
 * @method static Builder|IssueReportDetail newModelQuery()
 * @method static Builder|IssueReportDetail newQuery()
 * @method static Builder|IssueReportDetail query()
 * @method static Builder|IssueReportDetail whereCreatedAt($value)
 * @method static Builder|IssueReportDetail whereDescription($value)
 * @method static Builder|IssueReportDetail whereId($value)
 * @method static Builder|IssueReportDetail whereIssueReportId($value)
 * @method static Builder|IssueReportDetail whereUpdatedAt($value)
 * @method static Builder|IssueReportDetail whereUserId($value)
 * @method static Builder|IssueReportDetail whereUserType($value)
 * @property-read User $client
 * @property-read Model|Eloquent $model
 * @mixin Eloquent
 * @property int|null $district_id
 * @method static \Illuminate\Database\Eloquent\Builder|IssueReportDetail whereDistrictId($value)
 */
	class IssueReportDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $item_category_id
 * @property string $name
 * @property string|null $description
 * @property int $packaging_unit_id
 * @property string $selling_price
 * @property bool $vatable
 * @property float $vat_rate
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ItemFactory factory(...$parameters)
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereIsActive($value)
 * @method static Builder|Item whereItemCategoryId($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item wherePackagingUnitId($value)
 * @method static Builder|Item whereSellingPrice($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item whereVatRate($value)
 * @method static Builder|Item whereVatable($value)
 * @property-read \App\Models\ItemCategory $category
 * @property-read \App\Models\PackagingUnit $packagingUnit
 * @property-read \App\Models\Stock|null $stock
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $stockMovements
 * @property-read int|null $stock_movements_count
 * @property int|null $operator_id
 * @method static Builder|Item whereOperatorId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read int $qty
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $stockMovements
 */
	class Item extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ItemCategory
 *
 * @property int $id
 * @property string $name
 * @property bool $is_meter
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ItemCategoryFactory factory(...$parameters)
 * @method static Builder|ItemCategory newModelQuery()
 * @method static Builder|ItemCategory newQuery()
 * @method static Builder|ItemCategory query()
 * @method static Builder|ItemCategory whereCreatedAt($value)
 * @method static Builder|ItemCategory whereId($value)
 * @method static Builder|ItemCategory whereIsActive($value)
 * @method static Builder|ItemCategory whereIsMeter($value)
 * @method static Builder|ItemCategory whereName($value)
 * @method static Builder|ItemCategory whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @property int|null $operator_id
 * @method static Builder|ItemCategory whereOperatorId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 */
	class ItemCategory extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\ItemSellingPrice
 *
 * @property int $id
 * @property int $item_id
 * @property int $operation_area_id
 * @property int $stock_movement_id
 * @property string $price
 * @property int $quantity
 * @property int|null $parent_movement_id
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\StockMovement $stockMovement
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereParentMovementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereStockMovementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ItemSellingPrice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JournalEntry
 *
 * @property int $id
 * @property string $date
 * @property int $debit_ledger_croup
 * @property int $debit_ledger
 * @property int $credit_ledger_croup
 * @property int $credit_ledger
 * @property int|null $currency_id
 * @property string $amount
 * @property string $description
 * @property int $operation_area_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|JournalEntry newModelQuery()
 * @method static Builder|JournalEntry newQuery()
 * @method static Builder|JournalEntry query()
 * @method static Builder|JournalEntry whereAmount($value)
 * @method static Builder|JournalEntry whereCreatedAt($value)
 * @method static Builder|JournalEntry whereCreditLedger($value)
 * @method static Builder|JournalEntry whereCreditLedgerCroup($value)
 * @method static Builder|JournalEntry whereCurrencyId($value)
 * @method static Builder|JournalEntry whereDate($value)
 * @method static Builder|JournalEntry whereDebitLedger($value)
 * @method static Builder|JournalEntry whereDebitLedgerCroup($value)
 * @method static Builder|JournalEntry whereDescription($value)
 * @method static Builder|JournalEntry whereId($value)
 * @method static Builder|JournalEntry whereOperationAreaId($value)
 * @method static Builder|JournalEntry whereUpdatedAt($value)
 * @method static Builder|JournalEntry whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ChartAccount $creditLedger
 * @property-read \App\Models\ChartAccount $creditLegderGroup
 * @property-read \App\Models\ChartAccount $debitLedger
 * @property-read \App\Models\ChartAccount $debitLegderGroup
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 */
	class JournalEntry extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\LedgerMigration
 *
 * @property int $id
 * @property int $ledger_group
 * @property int $ledger_category
 * @property int $ledger_no
 * @property string $amount
 * @property string $balance_type
 * @property int $currency_id
 * @property int $operation_area_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|LedgerMigration newModelQuery()
 * @method static Builder|LedgerMigration newQuery()
 * @method static Builder|LedgerMigration query()
 * @method static Builder|LedgerMigration whereAmount($value)
 * @method static Builder|LedgerMigration whereBalanceType($value)
 * @method static Builder|LedgerMigration whereCreatedAt($value)
 * @method static Builder|LedgerMigration whereCurrencyId($value)
 * @method static Builder|LedgerMigration whereId($value)
 * @method static Builder|LedgerMigration whereLedgerCategory($value)
 * @method static Builder|LedgerMigration whereLedgerGroup($value)
 * @method static Builder|LedgerMigration whereLedgerNo($value)
 * @method static Builder|LedgerMigration whereOperationAreaId($value)
 * @method static Builder|LedgerMigration whereUpdatedAt($value)
 * @method static Builder|LedgerMigration whereUserId($value)
 * @property int|null $ledger_id
 * @property-read string $balance_color
 * @property-read \App\Models\ChartAccount|null $ledger
 * @property-read \App\Models\ChartAccount $ledgerCategory
 * @property-read \App\Models\ChartAccount $ledgerGroup
 * @method static Builder|LedgerMigration whereLedgerId($value)
 * @mixin Eloquent
 */
	class LedgerMigration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LegalType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 * @property-read int|null $document_types_count
 * @method static \Database\Factories\LegalTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegalType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentType> $documentTypes
 */
	class LegalType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Meter
 *
 * @method static \Database\Factories\MeterFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Meter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meter query()
 * @mixin \Eloquent
 */
	class Meter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MeterRequest
 *
 * @property int $id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $request_id
 * @property string $meter_number
 * @property string $subscription_number
 * @property string $last_index
 * @property string $balance
 * @method static Builder|MeterRequest newModelQuery()
 * @method static Builder|MeterRequest newQuery()
 * @method static Builder|MeterRequest query()
 * @method static Builder|MeterRequest whereBalance($value)
 * @method static Builder|MeterRequest whereCreatedAt($value)
 * @method static Builder|MeterRequest whereId($value)
 * @method static Builder|MeterRequest whereLastIndex($value)
 * @method static Builder|MeterRequest whereMeterNumber($value)
 * @method static Builder|MeterRequest whereRequestId($value)
 * @method static Builder|MeterRequest whereStatus($value)
 * @method static Builder|MeterRequest whereSubscriptionNumber($value)
 * @method static Builder|MeterRequest whereUpdatedAt($value)
 * @property int|null $item_category_id
 * @property int|null $item_id
 * @property-read \App\Models\Billing|null $billing
 * @property-read \App\Models\Request $request
 * @method static Builder|MeterRequest whereItemCategoryId($value)
 * @method static Builder|MeterRequest whereItemId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read int|null $delivery_items_count
 * @property-read \App\Models\Item|null $item
 * @property-read \App\Models\ItemCategory|null $itemCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $stockMovementDetails
 * @property-read int|null $stock_movement_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Billing> $billings
 * @property-read int|null $billings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $stockMovementDetails
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Billing> $billings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $stockMovementDetails
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Billing> $billings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $stockMovementDetails
 */
	class MeterRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OperationArea
 *
 * @property int $id
 * @property string $name
 * @property string|null $contact_person_name
 * @property string|null $contact_person_phone
 * @property string|null $contact_person_email
 * @property int|null $district_id
 * @property int $operator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\District|null $district
 * @property-read \App\Models\Operator $operator
 * @method static \Database\Factories\OperationAreaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereContactPersonEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereContactPersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereContactPersonPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChartAccount> $chartOfAccounts
 * @property-read int|null $chart_of_accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 * @property-read int|null $bill_charges_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @mixin \Eloquent
 * @property string|null $license_number
 * @property string|null $valid_from
 * @property string|null $valid_to
 * @property string|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChartAccount> $chartOfAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReport> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationArea whereValidTo($value)
 */
	class OperationArea extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Operator
 *
 * @property int $id
 * @property string $name
 * @property int $legal_type_id
 * @property string $id_type
 * @property string $doc_number
 * @property string|null $address
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $sector_id
 * @property int|null $cell_id
 * @property int|null $village_id
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $clms_id
 * @property-read Cell|null $cell
 * @property-read District|null $district
 * @property-read string $full_address
 * @property-read string $logo_url
 * @property-read LegalType $legalType
 * @property-read Collection<int, OperationArea> $operationAreas
 * @property-read int|null $operation_areas_count
 * @property-read Province|null $province
 * @property-read Sector|null $sector
 * @property-read Village|null $village
 * @method static OperatorFactory factory(...$parameters)
 * @method static Builder|Operator newModelQuery()
 * @method static Builder|Operator newQuery()
 * @method static Builder|Operator query()
 * @method static Builder|Operator whereAddress($value)
 * @method static Builder|Operator whereCellId($value)
 * @method static Builder|Operator whereClmsId($value)
 * @method static Builder|Operator whereCreatedAt($value)
 * @method static Builder|Operator whereDistrictId($value)
 * @method static Builder|Operator whereDocNumber($value)
 * @method static Builder|Operator whereId($value)
 * @method static Builder|Operator whereIdType($value)
 * @method static Builder|Operator whereLegalTypeId($value)
 * @method static Builder|Operator whereLogo($value)
 * @method static Builder|Operator whereName($value)
 * @method static Builder|Operator whereProvinceId($value)
 * @method static Builder|Operator whereSectorId($value)
 * @method static Builder|Operator whereUpdatedAt($value)
 * @method static Builder|Operator whereVillageId($value)
 * @property-read Collection<int, \App\Models\Customer> $customers
 * @property-read int|null $customers_count
 * @property-read Collection<int, \App\Models\Stock> $stocks
 * @property-read int|null $stocks_count
 * @property-read Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property string|null $prefix
 * @property-read Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read Collection<int, \App\Models\Request> $requests
 * @property-read int|null $requests_count
 * @method static Builder|Operator wherePrefix($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Customer> $customers
 * @property-read string $initials
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReport> $issues
 * @property-read int|null $issues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OperationArea> $operationAreas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Request> $requests
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock> $stocks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 */
	class Operator extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PackagingUnit
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PackagingUnitFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PackagingUnit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $subscription_number
 * @property string $bank_reference_number
 * @property string $payment_date
 * @property string $source
 * @property int $payment_mapping_id
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBankReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMappingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSubscriptionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @property int|null $billing_id
 * @property string|null $narration
 * @property-read \App\Models\Billing|null $billing
 * @property-read \App\Models\PaymentMapping|null $paymentMapping
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBillingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereNarration($value)
 * @mixin \Eloquent
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentConfiguration
 *
 * @property int $id
 * @property int $payment_type_id
 * @property int $request_type_id
 * @property int $operator_id
 * @property int $operation_area
 * @property float $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PaymentConfiguration newModelQuery()
 * @method static Builder|PaymentConfiguration newQuery()
 * @method static Builder|PaymentConfiguration query()
 * @method static Builder|PaymentConfiguration whereAmount($value)
 * @method static Builder|PaymentConfiguration whereCreatedAt($value)
 * @method static Builder|PaymentConfiguration whereId($value)
 * @method static Builder|PaymentConfiguration whereOperationArea($value)
 * @method static Builder|PaymentConfiguration whereOperatorId($value)
 * @method static Builder|PaymentConfiguration wherePaymentTypeId($value)
 * @method static Builder|PaymentConfiguration whereRequestTypeId($value)
 * @method static Builder|PaymentConfiguration whereUpdatedAt($value)
 * @property int $operation_area_id
 * @property bool $is_active
 * @property-read OperationArea $operationArea
 * @property-read Operator $operator
 * @property-read PaymentType $paymentType
 * @property-read RequestType $requestType
 * @method static Builder|PaymentConfiguration whereIsActive($value)
 * @method static Builder|PaymentConfiguration whereOperationAreaId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentMapping> $mappings
 * @property-read int|null $mappings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentMapping> $mappings
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentMapping> $mappings
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentMapping> $mappings
 */
	class PaymentConfiguration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentDeclaration
 *
 * @property int $id
 * @property int|null $request_id
 * @property int $payment_configuration_id
 * @property string $amount
 * @property string|null $payment_reference
 * @property string $type
 * @property string $balance
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $status_color
 * @method static Builder|PaymentDeclaration newModelQuery()
 * @method static Builder|PaymentDeclaration newQuery()
 * @method static Builder|PaymentDeclaration query()
 * @method static Builder|PaymentDeclaration whereAmount($value)
 * @method static Builder|PaymentDeclaration whereBalance($value)
 * @method static Builder|PaymentDeclaration whereCreatedAt($value)
 * @method static Builder|PaymentDeclaration whereId($value)
 * @method static Builder|PaymentDeclaration wherePaymentConfigurationId($value)
 * @method static Builder|PaymentDeclaration wherePaymentReference($value)
 * @method static Builder|PaymentDeclaration whereRequestId($value)
 * @method static Builder|PaymentDeclaration whereStatus($value)
 * @method static Builder|PaymentDeclaration whereType($value)
 * @method static Builder|PaymentDeclaration whereUpdatedAt($value)
 * @property-read \App\Models\PaymentConfiguration $paymentConfig
 * @property-read \App\Models\Request|null $request
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentHistory> $paymentHistories
 * @property-read int|null $payment_histories_count
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentHistory> $paymentHistories
 */
	class PaymentDeclaration extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\PaymentDetail
 *
 * @property int $id
 * @property int $payment_id
 * @property int $billing_id
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereBillingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentHistory
 *
 * @property int $id
 * @property int $payment_declaration_id
 * @property int $payment_mapping_id
 * @property string $amount
 * @property string|null $psp_reference_number
 * @property string $payment_date
 * @property string|null $narration
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PaymentHistory newModelQuery()
 * @method static Builder|PaymentHistory newQuery()
 * @method static Builder|PaymentHistory query()
 * @method static Builder|PaymentHistory whereAmount($value)
 * @method static Builder|PaymentHistory whereCreatedAt($value)
 * @method static Builder|PaymentHistory whereId($value)
 * @method static Builder|PaymentHistory whereNarration($value)
 * @method static Builder|PaymentHistory wherePaymentDate($value)
 * @method static Builder|PaymentHistory wherePaymentDeclarationId($value)
 * @method static Builder|PaymentHistory wherePaymentMappingId($value)
 * @method static Builder|PaymentHistory wherePspReferenceNumber($value)
 * @method static Builder|PaymentHistory whereUpdatedAt($value)
 * @property-read \App\Models\PaymentMapping $mapping
 * @property-read \App\Models\PaymentDeclaration $paymentDeclaration
 * @mixin Eloquent
 */
	class PaymentHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentMapping
 *
 * @property int $id
 * @property int $psp_account_id
 * @property int $payment_configuration_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping wherePaymentConfigurationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping wherePspAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereUpdatedAt($value)
 * @property-read \App\Models\PaymentServiceProviderAccount $account
 * @property-read \App\Models\PaymentConfiguration $paymentConfiguration
 * @property bool $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereIsActive($value)
 * @mixin \Eloquent
 */
	class PaymentMapping extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentServiceProvider
 *
 * @property int $id
 * @property string $name
 * @property string|null $ip
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PaymentServiceProvider newModelQuery()
 * @method static Builder|PaymentServiceProvider newQuery()
 * @method static Builder|PaymentServiceProvider query()
 * @method static Builder|PaymentServiceProvider whereClientId($value)
 * @method static Builder|PaymentServiceProvider whereClientSecret($value)
 * @method static Builder|PaymentServiceProvider whereCreatedAt($value)
 * @method static Builder|PaymentServiceProvider whereId($value)
 * @method static Builder|PaymentServiceProvider whereIp($value)
 * @method static Builder|PaymentServiceProvider whereName($value)
 * @method static Builder|PaymentServiceProvider whereUpdatedAt($value)
 * @property bool $is_active
 * @method static Builder|PaymentServiceProvider whereIsActive($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentServiceProviderAccount> $accounts
 * @property-read int|null $accounts_count
 * @property int|null $clms_id
 * @property bool $supports_payment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentServiceProviderAccount> $accounts
 * @property-read \App\Models\PaymentType $paymentType
 * @method static Builder|PaymentServiceProvider whereClmsId($value)
 * @method static Builder|PaymentServiceProvider whereSupportsPayment($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentServiceProviderAccount> $accounts
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentServiceProviderAccount> $accounts
 */
	class PaymentServiceProvider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentServiceProviderAccount
 *
 * @property int $id
 * @property int $payment_service_provider_id
 * @property string $account_name
 * @property string $account_number
 * @property string $currency
 * @property int|null $operation_area_id
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PaymentServiceProviderAccount newModelQuery()
 * @method static Builder|PaymentServiceProviderAccount newQuery()
 * @method static Builder|PaymentServiceProviderAccount query()
 * @method static Builder|PaymentServiceProviderAccount whereAccountName($value)
 * @method static Builder|PaymentServiceProviderAccount whereAccountNumber($value)
 * @method static Builder|PaymentServiceProviderAccount whereCreatedAt($value)
 * @method static Builder|PaymentServiceProviderAccount whereCurrency($value)
 * @method static Builder|PaymentServiceProviderAccount whereId($value)
 * @method static Builder|PaymentServiceProviderAccount whereIsActive($value)
 * @method static Builder|PaymentServiceProviderAccount whereOperationAreaId($value)
 * @method static Builder|PaymentServiceProviderAccount wherePaymentServiceProviderId($value)
 * @method static Builder|PaymentServiceProviderAccount whereUpdatedAt($value)
 * @property int|null $ledger_no
 * @method static Builder|PaymentServiceProviderAccount whereLedgerNo($value)
 * @property string|null $opening_date
 * @property string|null $closing_date
 * @property-read \App\Models\PaymentServiceProvider $paymentServiceProvider
 * @method static Builder|PaymentServiceProviderAccount whereClosingDate($value)
 * @method static Builder|PaymentServiceProviderAccount whereOpeningDate($value)
 * @property-read \App\Models\OperationArea|null $operationArea
 * @mixin Eloquent
 */
	class PaymentServiceProviderAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PaymentTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereUpdatedAt($value)
 * @property string|null $name_kin
 * @property bool $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentType whereNameKin($value)
 * @mixin \Eloquent
 */
	class PaymentType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Province
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 * @property-read int|null $districts_count
 * @method static \Database\Factories\ProvinceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\District> $districts
 */
	class Province extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $description
 * @property int $operation_area_id
 * @property int $created_by
 * @property int|null $approved_by
 * @property string $status Pending,Approved
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Purchase newModelQuery()
 * @method static Builder|Purchase newQuery()
 * @method static Builder|Purchase query()
 * @method static Builder|Purchase whereApprovedBy($value)
 * @method static Builder|Purchase whereCreatedAt($value)
 * @method static Builder|Purchase whereCreatedBy($value)
 * @method static Builder|Purchase whereDescription($value)
 * @method static Builder|Purchase whereId($value)
 * @method static Builder|Purchase whereOperationAreaId($value)
 * @method static Builder|Purchase whereStatus($value)
 * @method static Builder|Purchase whereSupplierId($value)
 * @method static Builder|Purchase whereUpdatedAt($value)
 * @property string|null $subtotal
 * @property string|null $tax_amount
 * @property string|null $tax_net_amount
 * @property string|null $total
 * @property-read Collection<int, FlowHistory> $flowHistories
 * @property-read int|null $flow_histories_count
 * @property-read string $status_color
 * @property-read Collection<int, StockMovementDetail> $movementDetails
 * @property-read int|null $movement_details_count
 * @property-read Collection<int, StockMovement> $movements
 * @property-read int|null $movements_count
 * @property-read Supplier $supplier
 * @method static Builder|Purchase whereSubtotal($value)
 * @method static Builder|Purchase whereTaxAmount($value)
 * @method static Builder|Purchase whereTaxNetAmount($value)
 * @method static Builder|Purchase whereTotal($value)
 * @property string|null $attachment
 * @property string|null $return_back_status
 * @property-read Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $createdBy
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $movementDetails
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $movements
 * @property-read \App\Models\OperationArea $operationArea
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereReturnBackStatus($value)
 */
	class Purchase extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Request
 *
 * @property int $id
 * @property int $customer_id
 * @property int $operator_id
 * @property int $request_type_id
 * @property int $water_usage_id
 * @property string $description
 * @property int|null $province_id
 * @property int|null $district_id
 * @property int|null $sector_id
 * @property int|null $cell_id
 * @property int|null $village_id
 * @property bool|null $new_connection_crosses_road
 * @property string|null $road_type
 * @property bool|null $equipment_payment
 * @property bool|null $digging_pipeline
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $meter_number
 * @property int|null $meter_qty
 * @property string|null $upi
 * @property string|null $ebm_date
 * @property int $created_by
 * @property int|null $approved_by
 * @property string|null $approval_date
 * @property string $status
 * @property-read Cell|null $cell
 * @property-read Customer $customer
 * @property-read District|null $district
 * @property-read Collection<int, FlowHistory> $flowHistories
 * @property-read int|null $flow_histories_count
 * @property-read string $status_color
 * @property-read Operator $operator
 * @property-read Province|null $province
 * @property-read RequestType $requestType
 * @property-read RoadCrossType|null $roadCrossType
 * @property-read Sector|null $sector
 * @property-read Village|null $village
 * @property-read WaterUsage $waterUsage
 * @method static Builder|Request newModelQuery()
 * @method static Builder|Request newQuery()
 * @method static Builder|Request query()
 * @method static Builder|Request whereApprovalDate($value)
 * @method static Builder|Request whereApprovedBy($value)
 * @method static Builder|Request whereCellId($value)
 * @method static Builder|Request whereCreatedAt($value)
 * @method static Builder|Request whereCreatedBy($value)
 * @method static Builder|Request whereCustomerId($value)
 * @method static Builder|Request whereDescription($value)
 * @method static Builder|Request whereDiggingPipeline($value)
 * @method static Builder|Request whereDistrictId($value)
 * @method static Builder|Request whereEbmDate($value)
 * @method static Builder|Request whereEquipmentPayment($value)
 * @method static Builder|Request whereId($value)
 * @method static Builder|Request whereMeterNumber($value)
 * @method static Builder|Request whereMeterQty($value)
 * @method static Builder|Request whereNewConnectionCrossesRoad($value)
 * @method static Builder|Request whereOperatorId($value)
 * @method static Builder|Request whereProvinceId($value)
 * @method static Builder|Request whereRequestTypeId($value)
 * @method static Builder|Request whereRoadType($value)
 * @method static Builder|Request whereSectorId($value)
 * @method static Builder|Request whereStatus($value)
 * @method static Builder|Request whereUpdatedAt($value)
 * @method static Builder|Request whereUpi($value)
 * @method static Builder|Request whereVillageId($value)
 * @method static Builder|Request whereWaterUsageId($value)
 * @property string|null $upi_attachment
 * @property int|null $water_network_id
 * @property int|null $operation_area_id
 * @property string|null $connection_fee
 * @property-read string $address
 * @property-read string|null $upi_attachment_url
 * @property-read Collection<int, StockMovementDetail> $items
 * @property-read int|null $items_count
 * @property-read Collection<int, MeterRequest> $meterNumbers
 * @property-read int|null $meter_numbers_count
 * @property-read Collection<int, PaymentDeclaration> $paymentDeclarations
 * @property-read int|null $payment_declarations_count
 * @property-read RequestAssignment|null $requestAssignment
 * @property-read Collection<int, RequestAssignment> $requestAssignments
 * @property-read int|null $request_assignments_count
 * @property-read RequestTechnician|null $technician
 * @property-read WaterNetwork|null $waterNetwork
 * @method static Builder|Request whereConnectionFee($value)
 * @method static Builder|Request whereOperationAreaId($value)
 * @method static Builder|Request whereUpiAttachment($value)
 * @method static Builder|Request whereWaterNetworkId($value)
 * @property-read Collection<int, RequestDelivery> $deliveries
 * @property-read int|null $deliveries_count
 * @property-read Collection<int, RequestDeliveryDetail> $deliveryDetails
 * @property-read int|null $delivery_details_count
 * @property-read mixed $total_delivered
 * @property-read mixed $total_qty
 * s
 * @property string|null $return_back_status
 * @property bool $customer_initiated
 * @property-read Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\OperationArea|null $operatingArea
 * @property-read \App\Models\OperationArea|null $operationArea
 * @property-read Collection<int, \App\Models\RequestPipeCross> $pipeCrosses
 * @property-read int|null $pipe_crosses_count
 * @method static Builder|Request operatorCustomer()
 * @method static Builder|Request whereCustomerInitiated($value)
 * @method static Builder|Request whereReturnBackStatus($value)
 * @mixin Eloquent
 * @property string|null $form_attachment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDelivery> $deliveries
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryDetails
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read string|null $form_attachment_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $items
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MeterRequest> $meterNumbers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentDeclaration> $paymentDeclarations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestPipeCross> $pipeCrosses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestAssignment> $requestAssignments
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereFormAttachment($value)
 */
	class Request extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\RequestAssignment
 *
 * @property int $id
 * @property int $request_id
 * @property int $user_id
 * @property int $assigned_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereAssignedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestAssignment whereUserId($value)
 * @mixin \Eloquent
 */
	class RequestAssignment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RequestDelivery
 *
 * @property int $id
 * @property int $request_id
 * @property string|null $batch_number
 * @property int $done_by
 * @property string|null $delivered_by_name
 * @property string|null $delivered_by_phone
 * @property string|null $delivery_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RequestDelivery newModelQuery()
 * @method static Builder|RequestDelivery newQuery()
 * @method static Builder|RequestDelivery query()
 * @method static Builder|RequestDelivery whereBatchNumber($value)
 * @method static Builder|RequestDelivery whereCreatedAt($value)
 * @method static Builder|RequestDelivery whereDeliveredByName($value)
 * @method static Builder|RequestDelivery whereDeliveredByPhone($value)
 * @method static Builder|RequestDelivery whereDeliveryDate($value)
 * @method static Builder|RequestDelivery whereDoneBy($value)
 * @method static Builder|RequestDelivery whereId($value)
 * @method static Builder|RequestDelivery whereRequestId($value)
 * @method static Builder|RequestDelivery whereUpdatedAt($value)
 * @property-read Collection<int, RequestDeliveryDetail> $details
 * @property-read int|null $details_count
 * @property-read Request $request
 * @property string|null $delivery_note
 * @property-read Collection<int, \App\Models\RequestDeliveryDetail> $details
 * @property-read string|null $deliver_note_url
 * @method static Builder|RequestDelivery whereDeliveryNote($value)
 * @property-read Collection<int, \App\Models\RequestDeliveryDetail> $details
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $details
 */
	class RequestDelivery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RequestDeliveryDetail
 *
 * @property int $id
 * @property int $request_delivery_id
 * @property int $meter_request_id
 * @property string|null $meter_number
 * @property int $quantity
 * @property int $remaining
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereMeterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereMeterRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereRequestDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereUpdatedAt($value)
 * @property int|null $stock_movement_detail_id
 * @property-read mixed $total
 * @property-read \App\Models\StockMovementDetail|null $requestItem
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereStockMovementDetailId($value)
 * @mixin \Eloquent
 */
	class RequestDeliveryDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RequestDurationConfiguration
 *
 * @property int $id
 * @property int $request_type_id
 * @property int $operator_id
 * @property int $operation_area
 * @property int $processing_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereOperationArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereProcessingDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereRequestTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereUpdatedAt($value)
 * @property int $operation_area_id
 * @property bool $is_active
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\Operator $operator
 * @property-read \App\Models\RequestType $requestType
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereOperationAreaId($value)
 * @mixin \Eloquent
 */
	class RequestDurationConfiguration extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RequestPipeCross
 *
 * @property int $id
 * @property int $request_id
 * @property int $road_cross_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RoadCrossType $pipeCross
 * @property-read \App\Models\Request $request
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereRoadCrossTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RequestPipeCross extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RequestTechnician
 *
 * @property int $id
 * @property int $request_id
 * @property string $name
 * @property string $phone_number
 * @property string|null $email
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestTechnician whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RequestTechnician extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RequestType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RequestTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereUpdatedAt($value)
 * @property bool $is_active
 * @property string|null $name_kin
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestType whereNameKin($value)
 * @mixin \Eloquent
 */
	class RequestType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoadCrossType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RoadCrossTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RoadCrossType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoadType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RoadTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class RoadType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sector
 *
 * @property int $id
 * @property string $name
 * @property int $district_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @property-read int|null $cells_count
 * @method static \Database\Factories\SectorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cell> $cells
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cluster> $clusters
 * @property-read int|null $clusters_count
 * @property-read \App\Models\District $district
 */
	class Sector extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShortUrl
 *
 * @property int $id
 * @property string $short_code
 * @property int $url_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl whereShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShortUrl whereUrlId($value)
 */
	class ShortUrl extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stock
 *
 * @property int $id
 * @property int $item_id
 * @property int $operation_area_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @property-read mixed $operator
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 */
	class Stock extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\StockMovement
 *
 * @property int $id
 * @property int $item_id
 * @property int $operation_area_id
 * @property int $opening_qty
 * @property float $qty_in
 * @property float $qty_out
 * @property string $description
 * @property string $type Adjustment,Purchase,Sale
 * @property int|null $adjustment_id
 * @property int|null $purchase_id
 * @property int|null $request_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|StockMovement newModelQuery()
 * @method static Builder|StockMovement newQuery()
 * @method static Builder|StockMovement query()
 * @method static Builder|StockMovement whereAdjustmentId($value)
 * @method static Builder|StockMovement whereCreatedAt($value)
 * @method static Builder|StockMovement whereDescription($value)
 * @method static Builder|StockMovement whereId($value)
 * @method static Builder|StockMovement whereItemId($value)
 * @method static Builder|StockMovement whereOpeningQty($value)
 * @method static Builder|StockMovement whereOperationAreaId($value)
 * @method static Builder|StockMovement wherePurchaseId($value)
 * @method static Builder|StockMovement whereQtyIn($value)
 * @method static Builder|StockMovement whereQtyOut($value)
 * @method static Builder|StockMovement whereRequestId($value)
 * @method static Builder|StockMovement whereType($value)
 * @method static Builder|StockMovement whereUpdatedAt($value)
 * @property float|null $unit_price
 * @property float $vat
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $details
 * @property-read int|null $details_count
 * @property-read mixed $total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\Purchase|null $purchase
 * @method static Builder|StockMovement whereUnitPrice($value)
 * @method static Builder|StockMovement whereVat($value)
 * @property int|null $qty_available
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static Builder|StockMovement whereQtyAvailable($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 */
	class StockMovement extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\StockMovementDetail
 *
 * @property int $id
 * @property int $item_id
 * @property int $quantity
 * @property string $status
 * @property string $unit_price
 * @property string $type
 * @property int $model_id
 * @property string $model_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|StockMovementDetail newModelQuery()
 * @method static Builder|StockMovementDetail newQuery()
 * @method static Builder|StockMovementDetail query()
 * @method static Builder|StockMovementDetail whereCreatedAt($value)
 * @method static Builder|StockMovementDetail whereId($value)
 * @method static Builder|StockMovementDetail whereItemId($value)
 * @method static Builder|StockMovementDetail whereModelId($value)
 * @method static Builder|StockMovementDetail whereModelType($value)
 * @method static Builder|StockMovementDetail whereQuantity($value)
 * @method static Builder|StockMovementDetail whereStatus($value)
 * @method static Builder|StockMovementDetail whereType($value)
 * @method static Builder|StockMovementDetail whereUnitPrice($value)
 * @method static Builder|StockMovementDetail whereUpdatedAt($value)
 * @property string|null $vat
 * @property-read mixed $total
 * @property-read \App\Models\Item $item
 * @property-read Model|\Eloquent $model
 * @method static Builder|StockMovementDetail whereVat($value)
 * @property string|null $adjustment_type increase or decrease
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read int|null $delivery_items_count
 * @property-read mixed $delivered_items
 * @property-read mixed $remaining_items
 * @method static Builder|StockMovementDetail whereAdjustmentType($value)
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @property-read mixed $total_vat_amount
 * @property-read mixed $vat_amount
 * @method static Builder|StockMovementDetail whereDescription($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $deliveryItems
 */
	class StockMovementDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string|null $email
 * @property string $address
 * @property string|null $contact_name
 * @property string|null $contact_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $operator_id
 * @method static SupplierFactory factory(...$parameters)
 * @method static Builder|Supplier newModelQuery()
 * @method static Builder|Supplier newQuery()
 * @method static Builder|Supplier query()
 * @method static Builder|Supplier whereAddress($value)
 * @method static Builder|Supplier whereContactEmail($value)
 * @method static Builder|Supplier whereContactName($value)
 * @method static Builder|Supplier whereCreatedAt($value)
 * @method static Builder|Supplier whereEmail($value)
 * @method static Builder|Supplier whereId($value)
 * @method static Builder|Supplier whereName($value)
 * @method static Builder|Supplier whereOperatorId($value)
 * @method static Builder|Supplier wherePhoneNumber($value)
 * @method static Builder|Supplier whereUpdatedAt($value)
 * @property-read \App\Models\Operator|null $operator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 */
	class Supplier extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\Url
 *
 * @property int $id
 * @property string $original_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Url newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url query()
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereOriginalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereUpdatedAt($value)
 */
	class Url extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $description
 * @property int|null $operator_id
 * @property int|null $operation_area
 * @property bool $is_super_admin
 * @property string|null $phone
 * @property string $status
 * @property string|null $password_changed_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Operator|null $operator
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User permission($permissions)
 * @method static Builder|User query()
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDescription($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsSuperAdmin($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereOperationArea($value)
 * @method static Builder|User whereOperatorId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePasswordChangedAt($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @property int|null $institution_id
 * @method static Builder|User whereInstitutionId($value)
 * @property-read Collection<int, Billing> $bills
 * @property-read int|null $bills_count
 * @property-read Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Institution|null $institution
 * @property-read Collection<int, \App\Models\IssueReportDetail> $issueDetails
 * @property-read int|null $issue_details_count
 * @property-read \App\Models\OperationArea|null $operationArea
 * @mixin Eloquent
 * @property int|null $district_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Billing> $bills
 * @property-read \App\Models\District|null $district
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IssueReportDetail> $issueDetails
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDistrictId($value)
 */
	class User extends \Eloquent implements \OwenIt\Auditing\Contracts\Auditable {}
}

namespace App\Models{
/**
 * App\Models\UserManual
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $for_admin 0: for user, 1: for admin
 * @method static \Database\Factories\UserManualFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereForAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $file_kn
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereFileKn($value)
 */
	class UserManual extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Village
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $cell_id
 * @method static \Database\Factories\VillageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Village newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Village query()
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereCellId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Village whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Cell $cell
 */
	class Village extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WaterNetwork
 *
 * @property int $id
 * @property string $name
 * @property float $distance_covered
 * @property int $population_covered
 * @property int $operator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaterNetworkFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereDistanceCovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork wherePopulationCovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereUpdatedAt($value)
 * @property int|null $water_network_type_id
 * @property int|null $operation_area_id
 * @property-read \App\Models\Operator $operator
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereWaterNetworkTypeId($value)
 * @property-read \App\Models\OperationArea|null $operationArea
 * @property-read \App\Models\WaterNetworkType|null $waterNetworkType
 * @property int|null $water_network_status_id
 * @property-read \App\Models\WaterNetworkStatus|null $waterNetworkStatus
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereWaterNetworkStatusId($value)
 * @mixin \Eloquent
 * @property int|null $district_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cluster> $clusters
 * @property-read int|null $clusters_count
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereDistrictId($value)
 */
	class WaterNetwork extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WaterNetworkStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaterNetworkStatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class WaterNetworkStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WaterNetworkType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereUpdatedAt($value)
 * @property string|null $unit_price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 * @property-read int|null $bill_charges_count
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereUnitPrice($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillCharge> $billCharges
 */
	class WaterNetworkType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WaterUsage
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaterUsageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class WaterUsage extends \Eloquent {}
}

