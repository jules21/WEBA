<?php

namespace App\Models;

use App\Constants\Permission;
use App\Traits\GetClassName;
use App\Traits\HasStatusColor;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

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
 * @mixin Eloquent
 */
class Purchase extends Model
{
    use GetClassName, HasStatusColor;

    const PENDING = "Pending";
    const SUBMITTED = "Submitted";
    const APPROVED = "Approved";

    const REJECTED = "Rejected";

    protected $appends = ['status_color'];


    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);

        return $this->where('id', $id)->firstOrFail();
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'purchase_id');
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
            self::APPROVED,
            self::REJECTED
        ];
    }

    public function canBeReviewed(): bool
    {
        return $this->status === self::SUBMITTED
            && auth()->user()->operation_area
            && auth()->user()->can(Permission::ApprovePurchase);
    }

}
