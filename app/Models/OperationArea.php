<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OperationArea extends Model
{
    use HasFactory;

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);
        return $this->where('id', '=', $id)->firstOrFail();
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
