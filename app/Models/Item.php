<?php

namespace App\Models;

use Database\Factories\ItemFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $item_category_id
 * @property string $name
 * @property string|null $description
 * @property int $packaging_unit_id
 * @property string $selling_price
 * @property bool $vatable
 * @property float $vat_rate
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static ItemFactory factory(...$parameters)
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereIsActive($value)
 * @method static Builder|Item whereItemCategoryId($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item wherePackagingUnitId($value)
 * @method static Builder|Item whereSellingPrice($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item whereVatRate($value)
 * @method static Builder|Item whereVatable($value)
 *
 * @property-read \App\Models\ItemCategory $category
 * @property-read \App\Models\PackagingUnit $packagingUnit
 * @property-read \App\Models\Stock|null $stock
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMovement> $stockMovements
 * @property-read int|null $stock_movements_count
 * @property int|null $operator_id
 *
 * @method static Builder|Item whereOperatorId($value)
 *
 * @mixin Eloquent
 */
class Item extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $appends = ['qty'];
    protected $fillable = [
        'item_category_id',
        'name',
        'description',
        'packaging_unit_id',
        'selling_price',
        'vatable',
        'vat_rate',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function packagingUnit(): BelongsTo
    {
        return $this->belongsTo(PackagingUnit::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function getQtyAttribute()
    {
        return $this->stock->quantity ?? 0;
    }
}
