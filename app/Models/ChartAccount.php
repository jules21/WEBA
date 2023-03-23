<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ChartAccount
 *
 * @property int $id
 * @property int $operation_area_id
 * @property int $ledger_no
 * @property string $ledger_description
 * @property string $ledger_type
 * @property int|null $parent_ledger_no
 * @property int $level
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 * @property-read int|null $children_count
 * @property-read ChartAccount|null $parent
 * @method static \Database\Factories\ChartAccountFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLedgerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLedgerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereParentLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccount whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ChartAccount> $children
 * @mixin \Eloquent
 */
class ChartAccount extends Model
{
    use HasFactory;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_ledger_no', 'ledger_no');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_ledger_no', 'ledger_no');
    }
}
