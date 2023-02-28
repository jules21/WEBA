<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Storage;


class Operator extends Model
{
    use HasFactory;

    protected $appends = ['logo_url'];

    const LOGO_PATH = 'operators/logos/';

    public function resolveRouteBinding($value, $field = null)
    {
        $id = decryptId($value);
        // find the model by id
        return $this->where('id', $id)->firstOrFail();
    }

    public function legalType(): BelongsTo
    {
        return $this->belongsTo(LegalType::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function cell(): BelongsTo
    {
        return $this->belongsTo(Cell::class);
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }


    public function getFullAddressAttribute(): string
    {
        return $this->address . ' ' . $this->village->name . ' ' . $this->cell->name . ' ' . $this->sector->name . ' ' . $this->district->name . ' ' . $this->province->name;
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->logo ? Storage::url(self::LOGO_PATH . $this->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=A6CE39&background=1068BF';
    }

    public function operationAreas(): HasMany
    {
        return $this->hasMany(OperationArea::class);
    }


}
