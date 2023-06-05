<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property float|null $unit_price
 * @property float $vat
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovementDetail> $details
 * @property-read int|null $details_count
 * @property-read mixed $total
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\Purchase|null $purchase
 * @method static Builder|StockMovement whereUnitPrice($value)
 * @method static Builder|StockMovement whereVat($value)
 * @property int|null $qty_available
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static Builder|StockMovement whereQtyAvailable($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin Eloquent
 */
class StockMovement extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const StockOut = 'Stock Out';

    const StockIn = 'Stock In';

    const Adjustment = 'Adjustment';

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalAttribute()
    {
        return ($this->qty_in - $this->qty_out) * $this->unit_price;
    }

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function operationArea(): BelongsTo
    {
        return $this->belongsTo(OperationArea::class);
    }
}
