<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LedgerMigration
 *
 * @property int $id
 * @property int $ledger_group
 * @property int $ledger_category
 * @property int $ledger_no
 * @property string $amount
 * @property string $balance_type
 * @property int $currency_id
 * @property int $operation_area_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration query()
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereBalanceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereLedgerCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereLedgerGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LedgerMigration whereUserId($value)
 * @mixin \Eloquent
 */
class LedgerMigration extends Model
{
    use HasFactory;
}
