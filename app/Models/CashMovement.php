<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereDestinationLedger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement wherePspAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement wherePspId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereReferenceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereSourceLedger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereUserId($value)
 * @mixin \Eloquent
 */
class CashMovement extends Model
{
    use HasFactory;
}
