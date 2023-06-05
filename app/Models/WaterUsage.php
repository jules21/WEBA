<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WaterUsage
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaterUsageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterUsage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WaterUsage extends Model
{
    use HasFactory;
}
