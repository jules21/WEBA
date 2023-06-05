<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemSellingPrice
 *
 * @property int $id
 * @property int $item_id
 * @property int $operation_area_id
 * @property int $stock_movement_id
 * @property string $price
 * @property int $quantity
 * @property int|null $parent_movement_id
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\Item $item
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\StockMovement $stockMovement
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereParentMovementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereStockMovementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSellingPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemSellingPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'operation_area_id',
        'stock_movement_id',
        'price',
        'currency_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function operationArea()
    {
        return $this->belongsTo(OperationArea::class);
    }

    public function stockMovement()
    {
        return $this->belongsTo(StockMovement::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['item_id'] ?? null, function ($query, $item_id) {
            $query->where('item_id', '=', $item_id);
        });

        $query->when($filters['operation_area_id'] ?? null, function ($query, $operation_area_id) {
            $query->where('operation_area_id', '=', $operation_area_id);
        });

        $query->when($filters['stock_movement_id'] ?? null, function ($query, $stock_movement_id) {
            $query->where('stock_movement_id', '=', $stock_movement_id);
        });

        $query->when($filters['price'] ?? null, function ($query, $price) {
            $query->where('price', '=', $price);
        });

        $query->when($filters['currency_id'] ?? null, function ($query, $currency_id) {
            $query->where('currency_id', '=', $currency_id);
        });
    }
}
