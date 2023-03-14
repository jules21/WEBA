<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChartAccount extends Model
{
    use HasFactory;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_ledger_no', 'ledger_no');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_ledger_no', 'ledger_no');
    }
}
