<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterUsageRequest;
use App\Http\Requests\UpdateWaterUsageRequest;
use App\Models\WaterUsage;

class WaterUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waterUsages = WaterUsage::query()->orderBy('id', 'DESC')->get();

        return view('admin.settings.water_usages', compact('waterUsages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaterUsageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaterUsageRequest $request, WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterUsage $waterUsage)
    {
        //
    }
}
