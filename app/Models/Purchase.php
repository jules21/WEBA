<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    const PENDING = "Pending";
    const APPROVED = "Approved";
    const REJECTED = "Rejected";

    protected $appends = ['status_color'];

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'purchase_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }


    public function getStatusColorAttribute(): string
    {
        switch ($this->status) {
            case self::PENDING:
                return 'info';
            case self::APPROVED:
                return 'success';
            case self::REJECTED:
                return 'danger';
        }
        return 'secondary';
    }

}
