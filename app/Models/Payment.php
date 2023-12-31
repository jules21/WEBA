<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $subscription_number
 * @property string $bank_reference_number
 * @property string $payment_date
 * @property string $source
 * @property int $payment_mapping_id
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBankReferenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMappingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSubscriptionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @property int|null $billing_id
 * @property string|null $narration
 * @property-read \App\Models\Billing|null $billing
 * @property-read \App\Models\PaymentMapping|null $paymentMapping
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBillingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereNarration($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function paymentMapping()
    {
        return $this->belongsTo(PaymentMapping::class);
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'subscription_number', 'subscription_number');
    }
}
