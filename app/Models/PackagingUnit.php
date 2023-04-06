<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PackagingUnit
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\PackagingUnitFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PackagingUnit whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PackagingUnit extends Model
{
    use HasFactory;
}
