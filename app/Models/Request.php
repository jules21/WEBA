<?php

namespace App\Models;

use App\Traits\HasAddress;
use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

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
 * @mixin Eloquent
 */
class Request extends Model
{
    protected $appends = ['status_color'];
    use HasAddress;
    use HasStatusColor;

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

    // static method to get class name with namespace
    public function getClassName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    const ASSIGNED = 'Assigned';
    const PROPOSE_TO_APPROVE = 'Propose to approve';
    const REJECTED = 'Rejected';
    const APPROVED = 'Approved';
    const ASSIGNING_METER = 'Assigning meter';

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
                self::ASSIGNING_METER,
                self::REJECTED
            ];
        }
        return [];
    }


}
