<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
