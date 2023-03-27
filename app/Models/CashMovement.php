<?php

namespace App\Models;

use App\Traits\ForOperator;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\CashMovement
 *
 * @property int $id
 * @property string $date
 * @property string $transaction_type
 * @property int $psp_id
 * @property int $psp_account_id
 * @property int $source_ledger
 * @property int $destination_ledger
 * @property int|null $currency_id
 * @property string $amount
 * @property string $description
 * @property string|null $reference_no
 * @property int $operation_area_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CashMovement newModelQuery()
 * @method static Builder|CashMovement newQuery()
 * @method static Builder|CashMovement query()
 * @method static Builder|CashMovement whereAmount($value)
 * @method static Builder|CashMovement whereCreatedAt($value)
 * @method static Builder|CashMovement whereCurrencyId($value)
 * @method static Builder|CashMovement whereDate($value)
 * @method static Builder|CashMovement whereDescription($value)
 * @method static Builder|CashMovement whereDestinationLedger($value)
 * @method static Builder|CashMovement whereId($value)
 * @method static Builder|CashMovement whereOperationAreaId($value)
 * @method static Builder|CashMovement wherePspAccountId($value)
 * @method static Builder|CashMovement wherePspId($value)
 * @method static Builder|CashMovement whereReferenceNo($value)
 * @method static Builder|CashMovement whereSourceLedger($value)
 * @method static Builder|CashMovement whereTransactionType($value)
 * @method static Builder|CashMovement whereUpdatedAt($value)
 * @method static Builder|CashMovement whereUserId($value)
 * @property-read \App\Models\PaymentServiceProvider|null $paymentServiceProvider
 * @property-read \App\Models\PaymentServiceProviderAccount|null $paymentServiceProviderAccount
 * @mixin Eloquent
 */
class CashMovement extends Model
{
    use ForOperator;

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', decryptId($value))->firstOrFail();
    }

    public function paymentServiceProvider(): BelongsTo
    {
        return $this->belongsTo(PaymentServiceProvider::class, 'psp_id');
    }

    public function paymentServiceProviderAccount(): BelongsTo
    {
        return $this->belongsTo(PaymentServiceProviderAccount::class, 'psp_account_id');
    }
}
