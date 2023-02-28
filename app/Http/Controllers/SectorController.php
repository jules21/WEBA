<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;
use App\Models\District;
use App\Models\Sector;

class SectorController extends Controller
{
    public function index()
    {
        return Sector::query()->get();
    }

    public function getByDistrict(District $district)
    {
        return $district->sectors()->get();
    }
}
