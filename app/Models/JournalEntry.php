<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\JournalEntry
 *
 * @property int $id
 * @property string $date
 * @property int $debit_ledger_croup
 * @property int $debit_ledger
 * @property int $credit_ledger_croup
 * @property int $credit_ledger
 * @property int|null $currency_id
 * @property string $amount
 * @property string $description
 * @property int $operation_area_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereCreditLedger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereCreditLedgerCroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereDebitLedger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereDebitLedgerCroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JournalEntry whereUserId($value)
 * @mixin \Eloquent
 */
class JournalEntry extends Model
{
    use HasFactory;
}
