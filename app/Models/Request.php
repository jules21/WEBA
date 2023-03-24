<?php

namespace App\Models;

use App\Constants\Permission;
use App\Traits\GetClassName;
use App\Traits\HasAddress;
use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use ReflectionClass;
use Storage;

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
 * @property-read Collection<int, \App\Models\RequestDelivery> $deliveries
 * @property-read int|null $deliveries_count
 * @property-read Collection<int, \App\Models\RequestDeliveryDetail> $deliveryDetails
 * @property-read int|null $delivery_details_count
 * @property-read mixed $total_delivered
 * @property-read mixed $total_qty
 *
 *
 * s
 * @mixin Eloquent
 */
class Request extends Model
{
    protected $appends = ['status_color', 'upi_attachment_url', 'total_qty', 'total_delivered'];
    use HasAddress;
    use HasStatusColor;
    use GetClassName;


    const PENDING = 'Pending';
    const ASSIGNED = 'Assigned';
    const PROPOSE_TO_APPROVE = 'Propose to approve';
    const REJECTED = 'Rejected';
    const APPROVED = 'Approved';
    const METER_ASSIGNED = "Meter Assigned";
    const PARTIALLY_DELIVERED = "Partially Delivered";
    const DELIVERED = "Delivered";
    const CANCELLED = "Cancelled";


    const UPI_ATTACHMENT_PATH = 'requests/upi/';

    public function getUpiAttachmentUrlAttribute(): ?string
    {
        $upi_attachment = optional($this->attributes)['upi_attachment'];
        if ($upi_attachment)
            return Storage::url(self::UPI_ATTACHMENT_PATH . $upi_attachment);
        return null;
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);
        return $this->where('id', '=', $id)->firstOrFail();
    }

    public function requestType(): BelongsTo
    {
        return $this->belongsTo(RequestType::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function cell(): BelongsTo
    {
        return $this->belongsTo(Cell::class);
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    public function waterUsage(): BelongsTo
    {
        return $this->belongsTo(WaterUsage::class);
    }

    public function roadCrossType(): BelongsTo
    {
        return $this->belongsTo(RoadCrossType::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }


    // create a polymorphic relationship
    public function flowHistories(): MorphMany
    {
        return $this->morphMany(FlowHistory::class, 'model', 'model_type', 'model_id');
    }

    public function requestAssignments(): HasMany
    {
        return $this->hasMany(RequestAssignment::class);
    }

    public function requestAssignment(): HasOne
    {
        return $this->hasOne(RequestAssignment::class);
    }


    public function getApprovalStatuses(): array
    {
        if ($this->status == self::ASSIGNED) {
            return [
                self::PROPOSE_TO_APPROVE,
                self::REJECTED
            ];
        } elseif ($this->status == self::PROPOSE_TO_APPROVE) {
            return [
                self::APPROVED,
                self::REJECTED
            ];
        } elseif ($this->status == self::APPROVED) {
            return [
                self::METER_ASSIGNED,
                self::REJECTED
            ];
        }
        return [];
    }

    public function items(): MorphMany
    {
        return $this->morphMany(StockMovementDetail::class, 'model', 'model_type', 'model_id');
    }

    public function technician(): HasOne
    {
        return $this->hasOne(RequestTechnician::class);
    }

    public function meterNumbers(): HasMany
    {
        return $this->hasMany(MeterRequest::class);
    }

    public function canBeReviewed(): bool
    {
        return $this->status != self::PENDING && !is_null($this->water_network_id);
    }


    public function canBeApprovedByMe(): bool
    {
        $user = auth()->user();

        if ($user->can(Permission::ReviewRequest) && $this->status == self::ASSIGNED) {
            return true;
        } elseif ($user->can(Permission::ApproveRequest) && $this->status == self::PROPOSE_TO_APPROVE) {
            return true;
        } elseif ($user->can(Permission::AssignMeterNumber) && $this->status == self::APPROVED && $this->meterNumbers->count() > 0) {
            return true;
        }
        return false;
    }

    public function canAssignMeterNumber(): bool
    {
        return $this->meterNumbers->count() < $this->meter_qty
            && $this->status == Request::APPROVED
            && auth()->user()->can(Permission::AssignMeterNumber)
            && !$this->pendingPayments(PaymentType::METERS_FEE);
    }

    public function waterNetwork(): BelongsTo
    {
        return $this->belongsTo(WaterNetwork::class);
    }

    public function paymentDeclarations(): HasMany
    {
        return $this->hasMany(PaymentDeclaration::class);
    }

    public function pendingPayments($withoutPaymentTypeId = null): bool
    {
        return $this->paymentDeclarations()
            ->where(\DB::raw("lower(status)"), PaymentDeclaration::ACTIVE)
            ->when($withoutPaymentTypeId, function ($query) use ($withoutPaymentTypeId) {
                $query->whereHas('paymentConfig', function ($query) use ($withoutPaymentTypeId) {
                    $query->where('payment_type_id', '!=', $withoutPaymentTypeId);
                });
            })
            ->exists();
    }


    public function canAddMaterials(): bool
    {
        return $this->status == Request::ASSIGNED &&
            auth()->user()->can(Permission::ReviewRequest) &&
            !$this->equipment_payment;
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(RequestDelivery::class, 'request_id');
    }

    public function deliveryDetails(): HasManyThrough
    {
        return $this->hasManyThrough(RequestDeliveryDetail::class, RequestDelivery::class, 'request_id', 'request_delivery_id');
    }


    public function getTotalQtyAttribute()
    {
        return $this->items()->sum('quantity') + $this->meterNumbers()->count();
    }

    public function getTotalDeliveredAttribute()
    {
        return $this->deliveryDetails()->sum('quantity');
    }


}
