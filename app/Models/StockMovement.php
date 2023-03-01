<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StockMovement
 *
 * @property int $id
 * @property int $item_id
 * @property int $operation_area_id
 * @property int $opening_qty
 * @property float $qty_in
 * @property float $qty_out
 * @property string $description
 * @property string $type Adjustment,Purchase,Sale
 * @property int|null $adjustment_id
 * @property int|null $purchase_id
 * @property int|null $request_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereAdjustmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereOpeningQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereQtyIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereQtyOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StockMovement extends Model
{
    use HasFactory;
}
