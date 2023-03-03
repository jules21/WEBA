<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\District;
use App\Models\Province;

class DistrictController extends Controller
{
    public function index()
    {
        return District::query()->get();
    }

    public function getByProvince(Province $province)
    {
        return $province->districts()->get();
    }
}
