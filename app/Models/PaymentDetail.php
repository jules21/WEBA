<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentDetail
 *
 * @property int $id
 * @property int $payment_id
 * @property int $billing_id
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereBillingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentDetail whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PaymentDetail extends Model
{
    use HasFactory;
}
