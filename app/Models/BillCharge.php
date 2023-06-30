<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

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
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\WaterNetworkType $waterNetworkType
 * @property int|null $operator_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Operator|null $operator
 * @method static \Illuminate\Database\Eloquent\Builder|BillCharge whereOperatorId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @mixin \Eloquent
 */
class BillCharge extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    public function waterNetworkType()
    {
        return $this->belongsTo(WaterNetworkType::class, 'water_network_type_id');
    }

    public function operationArea()
    {
        return $this->belongsTo(OperationArea::class, 'operation_area_id');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }
}
