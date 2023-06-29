<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin \Eloquent
 */
class Stock extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'operation_area_id',
        'item_id',
        'quantity',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);

        return $this->where('id', $id)->firstOrFail();
    }

    protected $appends = ['operator'];

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function operationArea(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OperationArea::class);
    }

    //has many through inverse
    public function getOperatorAttribute()
    {
        return $this->operationArea->operator;
    }
}
