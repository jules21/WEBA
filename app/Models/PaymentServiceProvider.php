<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PaymentServiceProvider
 *
 * @property int $id
 * @property string $name
 * @property string|null $ip
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PaymentServiceProvider newModelQuery()
 * @method static Builder|PaymentServiceProvider newQuery()
 * @method static Builder|PaymentServiceProvider query()
 * @method static Builder|PaymentServiceProvider whereClientId($value)
 * @method static Builder|PaymentServiceProvider whereClientSecret($value)
 * @method static Builder|PaymentServiceProvider whereCreatedAt($value)
 * @method static Builder|PaymentServiceProvider whereId($value)
 * @method static Builder|PaymentServiceProvider whereIp($value)
 * @method static Builder|PaymentServiceProvider whereName($value)
 * @method static Builder|PaymentServiceProvider whereUpdatedAt($value)
 * @property bool $is_active
 * @method static Builder|PaymentServiceProvider whereIsActive($value)
 * @mixin Eloquent
 */
class PaymentServiceProvider extends Model
{
    public function accounts(): HasMany
    {
        return $this->hasMany(PaymentServiceProviderAccount::class, 'payment_service_provider_id');
    }
}
