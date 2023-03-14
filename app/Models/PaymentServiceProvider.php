<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentServiceProvider
 *
 * @property int $id
 * @property string $name
 * @property string|null $ip
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereUpdatedAt($value)
 * @property bool $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProvider whereIsActive($value)
 * @mixin \Eloquent
 */
class PaymentServiceProvider extends Model
{
    use HasFactory;
}
