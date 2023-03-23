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
 * App\Models\RequestDelivery
 *
 * @property int $id
 * @property int $request_id
 * @property string|null $batch_number
 * @property int $done_by
 * @property string|null $delivered_by_name
 * @property string|null $delivered_by_phone
 * @property string|null $delivery_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|RequestDelivery newModelQuery()
 * @method static Builder|RequestDelivery newQuery()
 * @method static Builder|RequestDelivery query()
 * @method static Builder|RequestDelivery whereBatchNumber($value)
 * @method static Builder|RequestDelivery whereCreatedAt($value)
 * @method static Builder|RequestDelivery whereDeliveredByName($value)
 * @method static Builder|RequestDelivery whereDeliveredByPhone($value)
 * @method static Builder|RequestDelivery whereDeliveryDate($value)
 * @method static Builder|RequestDelivery whereDoneBy($value)
 * @method static Builder|RequestDelivery whereId($value)
 * @method static Builder|RequestDelivery whereRequestId($value)
 * @method static Builder|RequestDelivery whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RequestDeliveryDetail> $details
 * @property-read int|null $details_count
 * @property-read \App\Models\Request $request
 * @mixin Eloquent
 */
class RequestDelivery extends Model
{
    public function details(): HasMany
    {
        return $this->hasMany(RequestDeliveryDetail::class, 'request_delivery_id');
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
