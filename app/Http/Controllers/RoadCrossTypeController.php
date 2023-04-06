<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoadCrossTypeRequest;
use App\Http\Requests\UpdateRoadCrossTypeRequest;
use App\Models\RoadCrossType;

class RoadCrossTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roads = RoadCrossType::query()->orderBy('id', 'DESC')->get();

        return view('admin.settings.road_cross_types', compact('roads'));
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
    public function store(StoreRoadCrossTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(RoadCrossType $roadCrossType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RoadCrossType $roadCrossType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoadCrossTypeRequest $request, RoadCrossType $roadCrossType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoadCrossType $roadCrossType)
    {
        //
    }
}
