<?php

namespace App\Models;

use App\Constants\BalanceType;
use App\Traits\HasEncryptId;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|LedgerMigration newModelQuery()
 * @method static Builder|LedgerMigration newQuery()
 * @method static Builder|LedgerMigration query()
 * @method static Builder|LedgerMigration whereAmount($value)
 * @method static Builder|LedgerMigration whereBalanceType($value)
 * @method static Builder|LedgerMigration whereCreatedAt($value)
 * @method static Builder|LedgerMigration whereCurrencyId($value)
 * @method static Builder|LedgerMigration whereId($value)
 * @method static Builder|LedgerMigration whereLedgerCategory($value)
 * @method static Builder|LedgerMigration whereLedgerGroup($value)
 * @method static Builder|LedgerMigration whereLedgerNo($value)
 * @method static Builder|LedgerMigration whereOperationAreaId($value)
 * @method static Builder|LedgerMigration whereUpdatedAt($value)
 * @method static Builder|LedgerMigration whereUserId($value)
 * @property int|null $ledger_id
 * @property-read string $balance_color
 * @property-read \App\Models\ChartAccount|null $ledger
 * @property-read \App\Models\ChartAccount $ledgerCategory
 * @property-read \App\Models\ChartAccount $ledgerGroup
 * @method static Builder|LedgerMigration whereLedgerId($value)
 * @mixin Eloquent
 */
class LedgerMigration extends Model
{
    use HasEncryptId;

    public function ledgerGroup(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'ledger_group');
    }

    public function ledgerCategory(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'ledger_category');
    }

    public function ledger(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'ledger_id');
    }

    public function getBalanceColorAttribute(): string
    {
        return $this->balance_type == BalanceType::DEBIT ? 'info' : 'success';

    }
}
