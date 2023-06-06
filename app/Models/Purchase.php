<?php

namespace App\Models;

use App\Constants\Permission;
use App\Constants\Status;
use App\Traits\GetClassName;
use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property-read Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read Collection<int, \App\Models\StockMovementDetail> $movementDetails
 * @property-read Collection<int, \App\Models\StockMovement> $movements
 * @method static Builder|Purchase whereAttachment($value)
 * @method static Builder|Purchase whereReturnBackStatus($value)
 * @property-read Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read Collection<int, \App\Models\FlowHistory> $flowHistories
 * @property-read Collection<int, \App\Models\StockMovementDetail> $movementDetails
 * @property-read Collection<int, \App\Models\StockMovement> $movements
 * @mixin Eloquent
 */
class Purchase extends Model implements Auditable
{
    use GetClassName, HasStatusColor, \OwenIt\Auditing\Auditable;


    protected $appends = ['status_color'];

    const ATTACHMENT_PATH = 'attachments/purchases/';


    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);

        return $this->where('id', $id)->firstOrFail();
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'purchase_id');
    }

    public function movementDetails(): MorphMany
    {
        return $this->morphMany(StockMovementDetail::class, 'model');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function flowHistories(): MorphMany
    {
        return $this->morphMany(FlowHistory::class, 'model');
    }

    public function getApprovalStatuses(): array
    {
        return [
            Status::APPROVED,
            Status::RETURN_BACK,
            Status::REJECTED,
        ];
    }

    public function canBeReviewed(): bool
    {
        return $this->status === Status::SUBMITTED
            && auth()->user()->operation_area
            && auth()->user()->can(Permission::ApproveStockIn);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
