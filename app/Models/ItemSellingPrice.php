<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
