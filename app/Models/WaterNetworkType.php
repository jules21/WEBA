<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WaterNetworkType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetworkType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WaterNetworkType extends Model
{
    use HasFactory;
}
