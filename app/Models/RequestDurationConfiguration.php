<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RequestDurationConfiguration
 *
 * @property int $id
 * @property int $request_type_id
 * @property int $operator_id
 * @property int $operation_area
 * @property int $processing_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereOperationArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereProcessingDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereRequestTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereUpdatedAt($value)
 *
 * @property int $operation_area_id
 * @property bool $is_active
 * @property-read \App\Models\OperationArea $operationArea
 * @property-read \App\Models\Operator $operator
 * @property-read \App\Models\RequestType $requestType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestDurationConfiguration whereOperationAreaId($value)
 *
 * @mixin \Eloquent
 */
class RequestDurationConfiguration extends Model
{
    use HasFactory;

    public function requestType()
    {
        return $this->belongsTo(RequestType::class, 'request_type_id');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function operationArea()
    {
        return $this->belongsTo(OperationArea::class, 'operation_area_id');
    }
}
