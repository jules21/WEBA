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
        //
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
     * @param  \App\Http\Requests\StoreWaterUsageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaterUsageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterUsage  $waterUsage
     * @return \Illuminate\Http\Response
     */
    public function show(WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterUsage  $waterUsage
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWaterUsageRequest  $request
     * @param  \App\Models\WaterUsage  $waterUsage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaterUsageRequest $request, WaterUsage $waterUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterUsage  $waterUsage
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterUsage $waterUsage)
    {
        //
    }
}
