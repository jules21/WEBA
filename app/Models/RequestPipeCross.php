<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RequestPipeCross
 *
 * @property int $id
 * @property int $request_id
 * @property int $road_cross_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RoadCrossType $pipeCross
 * @property-read \App\Models\Request $request
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross query()
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereRoadCrossTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RequestPipeCross whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RequestPipeCross extends Model
{
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function pipeCross(): BelongsTo
    {
        return $this->belongsTo(RoadCrossType::class, 'road_cross_type_id');
    }
}
