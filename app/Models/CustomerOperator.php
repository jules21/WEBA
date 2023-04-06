<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerOperator
 *
 * @property int $id
 * @property int $customer_id
 * @property int $operator_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerOperator whereOperatorId($value)
 *
 * @mixin \Eloquent
 */
class CustomerOperator extends Model
{
    use HasFactory;
}
