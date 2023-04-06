<?php

namespace App\Models;

use App\Traits\ForOperator;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|PaymentServiceProviderAccount newModelQuery()
 * @method static Builder|PaymentServiceProviderAccount newQuery()
 * @method static Builder|PaymentServiceProviderAccount query()
 * @method static Builder|PaymentServiceProviderAccount whereAccountName($value)
 * @method static Builder|PaymentServiceProviderAccount whereAccountNumber($value)
 * @method static Builder|PaymentServiceProviderAccount whereCreatedAt($value)
 * @method static Builder|PaymentServiceProviderAccount whereCurrency($value)
 * @method static Builder|PaymentServiceProviderAccount whereId($value)
 * @method static Builder|PaymentServiceProviderAccount whereIsActive($value)
 * @method static Builder|PaymentServiceProviderAccount whereOperationAreaId($value)
 * @method static Builder|PaymentServiceProviderAccount wherePaymentServiceProviderId($value)
 * @method static Builder|PaymentServiceProviderAccount whereUpdatedAt($value)
 *
 * @property int|null $ledger_no
 *
 * @method static Builder|PaymentServiceProviderAccount whereLedgerNo($value)
 *
 * @property string|null $opening_date
 * @property string|null $closing_date
 * @property-read \App\Models\PaymentServiceProvider $paymentServiceProvider
 *
 * @method static Builder|PaymentServiceProviderAccount whereClosingDate($value)
 * @method static Builder|PaymentServiceProviderAccount whereOpeningDate($value)
 *
 * @mixin Eloquent
 */
class PaymentServiceProviderAccount extends Model
{
    use ForOperator;

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);

        return $this->where('id', '=', $id)->firstOrFail();
    }

    public function paymentServiceProvider(): BelongsTo
    {
        return $this->belongsTo(PaymentServiceProvider::class);
    }

    public function operationArea(): BelongsTo
    {
        return $this->belongsTo(OperationArea::class);
    }
}
