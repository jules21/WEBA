<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MeterRequest
 *
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $request_id
 * @property string $meter_number
 * @property string $subscription_number
 * @property string $last_index
 * @property string $balance
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereLastIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereMeterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereSubscriptionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MeterRequest extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', '=', decryptId($value))->firstOrFail();
    }

    public function billing(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Billing::class, 'subscription_number', 'subscription_number');
    }
    public function request(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
