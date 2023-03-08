<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

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
 * @mixin Eloquent
 */
class StockMovementDetail extends Model
{

    protected $appends = ['total'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}
