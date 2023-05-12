<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Billing newModelQuery()
 * @method static Builder|Billing newQuery()
 * @method static Builder|Billing query()
 * @method static Builder|Billing whereAmount($value)
 * @method static Builder|Billing whereBalance($value)
 * @method static Builder|Billing whereCreatedAt($value)
 * @method static Builder|Billing whereId($value)
 * @method static Builder|Billing whereLastIndex($value)
 * @method static Builder|Billing whereMeterNumber($value)
 * @method static Builder|Billing whereStartingIndex($value)
 * @method static Builder|Billing whereSubscriptionNumber($value)
 * @method static Builder|Billing whereUnitPrice($value)
 * @method static Builder|Billing whereUpdatedAt($value)
 * @method static Builder|Billing whereUserId($value)
 *
 * @property string|null $comment
 * @property string|null $attachment
 * @property-read MeterRequest|null $meterRequest
 * @property-read User $user
 *
 * @method static Builder|Billing whereAttachment($value)
 * @method static Builder|Billing whereComment($value)
 *
 * @mixin Eloquent
 */
class Billing extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function user(): BelongsTo
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

    public function history(): HasMany
    {
        return $this->hasMany(Payment::class, 'billing_id', 'id');
    }
}
