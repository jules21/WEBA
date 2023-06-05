<?php

namespace App\Models;

use App\Constants\Permission;
use App\Constants\Status;
use App\Traits\GetClassName;
use App\Traits\HasStatusColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use OwenIt\Auditing\Contracts\Auditable;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read int|null $flow_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $movements
 * @property-read int|null $movements_count
 * @property-read \App\Models\OperationArea $operationArea
 * @property string|null $attachment
 * @property string|null $return_back_status
 * @property-read \App\Models\User|null $approvedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $createdBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read string $id_encrypted
 * @property-read string $status_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $items
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $movementDetails
 * @property-read int|null $movement_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $movements
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereReturnBackStatus($value)
 * @mixin \Eloquent
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

    public function operationArea(): \Illuminate\Database\Eloquent\Relations\BelongsTo
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

    public function movements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StockMovement::class, 'adjustment_id');
    }

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function movementDetails(): MorphMany
    {
        return $this->morphMany(StockMovementDetail::class, 'model');
    }
    public function getAttachment(): ?string
    {
        return $this->attachment ? Storage::url('public/adjustment/attachments'.$this->attachment) : null;
    }

    public function getIdEncryptedAttribute(): string
    {
        return encryptId($this->id);
    }


}
