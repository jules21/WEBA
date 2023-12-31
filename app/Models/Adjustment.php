<?php

namespace App\Models;

use App\Constants\Permission;
use App\Constants\Status;
use App\Traits\GetClassName;
use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;
use Storage;

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
 * @property-read Collection<int, Audit> $audits
 * @property-read Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read Collection<int, \App\Models\StockMovementDetail> $items
 * @property-read Collection<int, \App\Models\StockMovementDetail> $movementDetails
 * @property-read Collection<int, \App\Models\StockMovement> $movements
 * @method static \Database\Factories\AdjustmentFactory factory(...$parameters)
 * @mixin Eloquent
 */
class Adjustment extends Model implements Auditable
{
    use HasFactory, HasStatusColor, \OwenIt\Auditing\Auditable, GetClassName;

    protected $fillable = [
        'status',
        'description',
        'operation_area_id',
        'created_by',
        'approved_by',
    ];

    const PENDING = 'Pending';

    const SUBMITTED = 'Submitted';

    const APPROVED = 'Approved';

    const REJECTED = 'Rejected';

    protected $appends = ['status_color', 'id_encrypted'];

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);

        return $this->where('id', '=', $id)->firstOrFail();
    }

    public function operationArea(): BelongsTo
    {
        return $this->belongsTo(OperationArea::class);
    }

    public function items(): MorphMany
    {
        return $this->morphMany(StockMovementDetail::class, 'model', 'model_type', 'model_id');
    }

    public function flowHistories(): MorphMany
    {
        return $this->morphMany(FlowHistory::class, 'model');
    }

    public function getApprovalStatuses(): array
    {
        return [
            self::APPROVED,
            self::REJECTED,
            Status::RETURN_BACK,
        ];
    }

    public function canBeReviewed(): bool
    {
        return $this->status === self::SUBMITTED
            && auth()->user()->operation_area
            && auth()->user()->can(Permission::ApproveAdjustment);
    }

    public function canBeSubmitted(): bool
    {
        return $this->status === self::PENDING
            && auth()->user()->operation_area
            && auth()->user()->can(Permission::CreateAdjustment);
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'adjustment_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function movementDetails(): MorphMany
    {
        return $this->morphMany(StockMovementDetail::class, 'model');
    }

    public function getAttachment(): ?string
    {
        return $this->attachment ? Storage::url('public/adjustment/attachments' . $this->attachment) : null;
    }

    public function getIdEncryptedAttribute(): string
    {
        return encryptId($this->id);
    }


}
