<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Expense
 *
 * @property int $id
 * @property int $operation_area_id
 * @property string $date
 * @property string $amount
 * @property string $description
 * @property int $expense_ledger
 * @property int $expense_category
 * @property int $payment_ledger
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Expense newModelQuery()
 * @method static Builder|Expense newQuery()
 * @method static Builder|Expense query()
 * @method static Builder|Expense whereAmount($value)
 * @method static Builder|Expense whereCreatedAt($value)
 * @method static Builder|Expense whereDate($value)
 * @method static Builder|Expense whereDescription($value)
 * @method static Builder|Expense whereExpenseCategory($value)
 * @method static Builder|Expense whereExpenseLedger($value)
 * @method static Builder|Expense whereId($value)
 * @method static Builder|Expense whereOperationAreaId($value)
 * @method static Builder|Expense wherePaymentLedger($value)
 * @method static Builder|Expense whereUpdatedAt($value)
 * @method static Builder|Expense whereUserId($value)
 * @mixin Eloquent
 */
class Expense extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', decryptId($value))->firstOrFail();
    }

    public function expenseCategory(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'expense_category');
    }

    public function expenseLedger(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'expense_ledger');
    }

    public function paymentLedger(): BelongsTo
    {
        return $this->belongsTo(ChartAccount::class, 'payment_ledger');
    }


}
