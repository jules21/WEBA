<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|StockMovement newModelQuery()
 * @method static Builder|StockMovement newQuery()
 * @method static Builder|StockMovement query()
 * @method static Builder|StockMovement whereAdjustmentId($value)
 * @method static Builder|StockMovement whereCreatedAt($value)
 * @method static Builder|StockMovement whereDescription($value)
 * @method static Builder|StockMovement whereId($value)
 * @method static Builder|StockMovement whereItemId($value)
 * @method static Builder|StockMovement whereOpeningQty($value)
 * @method static Builder|StockMovement whereOperationAreaId($value)
 * @method static Builder|StockMovement wherePurchaseId($value)
 * @method static Builder|StockMovement whereQtyIn($value)
 * @method static Builder|StockMovement whereQtyOut($value)
 * @method static Builder|StockMovement whereRequestId($value)
 * @method static Builder|StockMovement whereType($value)
 * @method static Builder|StockMovement whereUpdatedAt($value)
 * @mixin Eloquent
 */
class StockMovement extends Model
{
    const Purchase = 'Purchase';
    const Sale = 'Sale';
    const Adjustment = 'Adjustment';

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalAttribute()
    {
        return ($this->qty_in - $this->qty_out) * $this->unit_price;
    }
}
