<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockMovementDetail
 *
 * @property int $id
 * @property int $item_id
 * @property int $quantity
 * @property string $status
 * @property string $unit_price
 * @property string $type
 * @property int $model_id
 * @property string $model_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovementDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockMovementDetail extends Model
{
    use HasFactory;
}
