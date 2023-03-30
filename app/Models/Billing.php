<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Billing
 *
 * @property int $id
 * @property string $starting_index
 * @property string $last_index
 * @property int $user_id
 * @property string $unit_price
 * @property string $meter_number
 * @property string $subscription_number
 * @property string $amount
 * @property string $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Billing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereLastIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereMeterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereStartingIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereSubscriptionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereUserId($value)
 * @property string|null $comment
 * @property string|null $attachment
 * @property-read \App\Models\MeterRequest|null $meterRequest
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereComment($value)
 * @mixin \Eloquent
 */
class Billing extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', '=', decryptId($value))->firstOrFail();
    }

    public function meterRequest(): BelongsTo
    {
        return $this->belongsTo(MeterRequest::class, 'subscription_number', 'subscription_number');
    }

    public function history()
    {
        return $this->hasMany(Payment::class, 'billing_id', 'id');
    }
}
