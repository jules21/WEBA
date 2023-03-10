<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WaterNetwork
 *
 * @property int $id
 * @property string $name
 * @property float $distance_covered
 * @property int $population_covered
 * @property int $operator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaterNetworkFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereDistanceCovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork wherePopulationCovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WaterNetwork extends Model
{
    use HasFactory;

    public function operator(){
        return $this->belongsTo(Operator::class,'operator_id');
    }
}
