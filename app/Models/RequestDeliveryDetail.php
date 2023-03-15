<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class RequestDeliveryDetail extends Model
{
    use HasFactory;
}
