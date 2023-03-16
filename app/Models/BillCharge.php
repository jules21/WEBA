<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BillCharge
 *
 * @property int $id
 * @property int $water_network_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $operation_area_id
 * @property string $unit_price
 * @method static \Database\Factories\BillChargeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereOperationAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereWaterNetworkTypeId($value)
 * @mixin \Eloquent
 */
class BillCharge extends Model
{
    use HasFactory;

    public function waterNetworkType(){
        return $this->belongsTo(WaterNetworkType::class,'water_network_type_id');
    }

    public function operationArea(){
        return $this->belongsTo(OperationArea::class,'operation_area_id');
    }
}
