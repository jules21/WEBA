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
 * @property int|null $water_network_type_id
 * @property int|null $operation_area_id
 * @property-read \App\Models\Operator $operator
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaterNetwork whereWaterNetworkTypeId($value)
 * @property-read \App\Models\OperationArea|null $operationArea
 * @property-read \App\Models\WaterNetworkType|null $waterNetworkType
 * @mixin \Eloquent
 */
class WaterNetwork extends Model
{
    use HasFactory;

    public function operator(){
        return $this->belongsTo(Operator::class,'operator_id');
    }

    public function waterNetworkType(){
        return $this->belongsTo(WaterNetworkType::class,'water_network_type_id');
    }

    public function operationArea(){
        return $this->belongsTo(OperationArea::class,'operation_area_id');
    }
}
