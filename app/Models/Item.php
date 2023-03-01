<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePackagingUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereVatRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereVatable($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFactory;
}
