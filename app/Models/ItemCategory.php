<?php

namespace App\Models;

use Database\Factories\ItemCategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ItemCategory
 *
 * @property int $id
 * @property string $name
 * @property bool $is_meter
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ItemCategoryFactory factory(...$parameters)
 * @method static Builder|ItemCategory newModelQuery()
 * @method static Builder|ItemCategory newQuery()
 * @method static Builder|ItemCategory query()
 * @method static Builder|ItemCategory whereCreatedAt($value)
 * @method static Builder|ItemCategory whereId($value)
 * @method static Builder|ItemCategory whereIsActive($value)
 * @method static Builder|ItemCategory whereIsMeter($value)
 * @method static Builder|ItemCategory whereName($value)
 * @method static Builder|ItemCategory whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @mixin Eloquent
 */
class ItemCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "is_meter",
        "is_active",
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
