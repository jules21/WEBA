<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RequestDeliveryDetail
 *
 * @property int $id
 * @property int $request_delivery_id
 * @property int $meter_request_id
 * @property string|null $meter_number
 * @property int $quantity
 * @property int $remaining
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereMeterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereMeterRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereRemaining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereRequestDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereUpdatedAt($value)
 * @property int|null $stock_movement_detail_id
 * @property-read mixed $total
 * @property-read \App\Models\StockMovementDetail|null $requestItem
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDeliveryDetail whereStockMovementDetailId($value)
 * @mixin \Eloquent
 */
class RequestDeliveryDetail extends Model
{
    public function requestItem(): BelongsTo
    {
        return $this->belongsTo(StockMovementDetail::class, 'stock_movement_detail_id');
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->requestItem->unit_price;
    }
}
