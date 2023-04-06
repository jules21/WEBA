<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CurrencyOperator
 *
 * @property int $id
 * @property int $operation_area_id
 * @property string $code
 * @property string $name
 * @property string|null $symbol
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\CurrencyOperatorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator query()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyOperator whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CurrencyOperator extends Model
{
    use HasFactory;
}
