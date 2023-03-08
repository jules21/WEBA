<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoadTypeRequest;
use App\Http\Requests\UpdateRoadTypeRequest;
use App\Models\RoadType;

class RoadTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreRoadTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoadTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoadType  $roadType
     * @return \Illuminate\Http\Response
     */
    public function show(RoadType $roadType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoadType  $roadType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoadType $roadType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoadTypeRequest  $request
     * @param  \App\Models\RoadType  $roadType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoadTypeRequest $request, RoadType $roadType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoadType  $roadType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoadType $roadType)
    {
        //
    }
}
