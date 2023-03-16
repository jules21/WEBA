<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestDelivery
 *
 * @property int $id
 * @property int $request_id
 * @property string|null $batch_number
 * @property int $done_by
 * @property string|null $delivered_by_name
 * @property string|null $delivered_by_phone
 * @property string|null $delivery_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereBatchNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereDeliveredByName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereDeliveredByPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereDoneBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDelivery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RequestDelivery extends Model
{
    use HasFactory;
}
