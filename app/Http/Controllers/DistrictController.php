<?php

namespace App\Http\Controllers;

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
