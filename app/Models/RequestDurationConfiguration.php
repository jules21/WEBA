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
 * @mixin \Eloquent
 */
class RequestDurationConfiguration extends Model
{
    use HasFactory;
}
