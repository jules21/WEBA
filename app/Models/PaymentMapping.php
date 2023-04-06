<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PaymentMapping
 *
 * @property int $id
 * @property int $psp_account_id
 * @property int $payment_configuration_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping wherePaymentConfigurationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping wherePspAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMapping whereUpdatedAt($value)
 *
 * @property-read \App\Models\PaymentServiceProviderAccount $account
 * @property-read \App\Models\PaymentConfiguration $paymentConfiguration
 *
 * @mixin \Eloquent
 */
class PaymentMapping extends Model
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(PaymentServiceProviderAccount::class, 'psp_account_id');
    }

    public function paymentConfiguration(): BelongsTo
    {
        return $this->belongsTo(PaymentConfiguration::class, 'payment_configuration_id');
    }
}
