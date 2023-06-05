<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WaterNetworkStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaterNetworkStatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WaterNetworkStatus extends Model
{
    use HasFactory;
}
