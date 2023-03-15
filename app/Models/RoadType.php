<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoadType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RoadTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoadType extends Model
{
    use HasFactory;
}
