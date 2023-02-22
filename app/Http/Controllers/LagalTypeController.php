<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLagalTypeRequest;
use App\Http\Requests\UpdateLagalTypeRequest;
use App\Models\LagalType;

class LagalTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreLagalTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLagalTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LagalType  $lagalType
     * @return \Illuminate\Http\Response
     */
    public function show(LagalType $lagalType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LagalType  $lagalType
     * @return \Illuminate\Http\Response
     */
    public function edit(LagalType $lagalType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLagalTypeRequest  $request
     * @param  \App\Models\LagalType  $lagalType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLagalTypeRequest $request, LagalType $lagalType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LagalType  $lagalType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LagalType $lagalType)
    {
        //
    }
}
