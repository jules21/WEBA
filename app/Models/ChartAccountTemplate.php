<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChartAccountTemplate
 *
 * @property int $id
 * @property int $ledger_no
 * @property string $ledger_description
 * @property string $ledger_type
 * @property int|null $parent_ledger_no
 * @property int $level
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\ChartAccountTemplateFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLedgerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLedgerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereParentLedgerNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChartAccountTemplate whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ChartAccountTemplate extends Model
{
    use HasFactory;
}
