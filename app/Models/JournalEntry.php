<?php

namespace App\Models;

use App\Traits\ForOperator;
use App\Traits\HasEncryptId;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|JournalEntry newModelQuery()
 * @method static Builder|JournalEntry newQuery()
 * @method static Builder|JournalEntry query()
 * @method static Builder|JournalEntry whereAmount($value)
 * @method static Builder|JournalEntry whereCreatedAt($value)
 * @method static Builder|JournalEntry whereCreditLedger($value)
 * @method static Builder|JournalEntry whereCreditLedgerCroup($value)
 * @method static Builder|JournalEntry whereCurrencyId($value)
 * @method static Builder|JournalEntry whereDate($value)
 * @method static Builder|JournalEntry whereDebitLedger($value)
 * @method static Builder|JournalEntry whereDebitLedgerCroup($value)
 * @method static Builder|JournalEntry whereDescription($value)
 * @method static Builder|JournalEntry whereId($value)
 * @method static Builder|JournalEntry whereOperationAreaId($value)
 * @method static Builder|JournalEntry whereUpdatedAt($value)
 * @method static Builder|JournalEntry whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ChartAccount $creditLedger
 * @property-read \App\Models\ChartAccount $creditLegderGroup
 * @property-read \App\Models\ChartAccount $debitLedger
 * @property-read \App\Models\ChartAccount $debitLegderGroup
 * @mixin Eloquent
 */
class JournalEntry extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasEncryptId, ForOperator;

    public function debitLegderGroup(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'debit_ledger_croup');
    }

    public function debitLedger(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'debit_ledger');
    }

    public function creditLegderGroup(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'credit_ledger_croup');
    }

    public function creditLedger(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'credit_ledger');
    }
}
