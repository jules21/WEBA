<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentServiceProviderAccount
 *
 * @property int $id
 * @property int $payment_service_provider_id
 * @property string $account_name
 * @property string $account_number
 * @property string $currency
 * @property int|null $operation_area_id
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount wherePaymentServiceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereUpdatedAt($value)
 * @property int|null $ledger_no
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentServiceProviderAccount whereLedgerNo($value)
 * @mixin \Eloquent
 */
class PaymentServiceProviderAccount extends Model
{
    use HasFactory;
}
