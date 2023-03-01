<?php

namespace App\Traits;

use App\Models\Cell;
use App\Models\District;
use App\Models\Province;
use App\Models\Sector;
use App\Models\Village;

trait HasAddress
{

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function getAddressAttribute(): string
    {
        return $this->province->name . '-' . $this->district->name . '-' . $this->sector->name . '-' . $this->cell->name??'' . '-' . $this->village->name ?? '';
    }
}
