<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoadCrossType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RoadCrossTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoadCrossType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoadCrossType extends Model
{
    use HasFactory;
}
