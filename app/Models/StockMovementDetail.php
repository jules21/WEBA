<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 */
class StockMovementDetail extends Model
{
    protected $appends = ['total', 'delivered_items'];

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

    public function deliveryItems(): HasMany
    {
        return $this->hasMany(RequestDeliveryDetail::class, 'stock_movement_detail_id');
    }

    public function getDeliveredItemsAttribute()
    {
        return $this->deliveryItems()->sum('quantity');
    }

    public function getRemainingItemsAttribute()
    {
        return $this->quantity - $this->delivered_items;
    }

    public function getVatAmountAttribute()
    {
        $basePrice = $this->basePrice();

        return $this->unit_price - $basePrice;
    }

    public function basePrice(): float
    {
        return $this->unit_price / (1 + ($this->vat / 100));
    }

    public function getTotalVatAmountAttribute()
    {
        return $this->quantity * $this->vat_amount;
    }
}
