<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChartAccountRequest;
use App\Http\Requests\UpdateChartAccountRequest;
use App\Models\ChartAccount;

class ChartAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreChartAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChartAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChartAccount  $chartAccount
     * @return \Illuminate\Http\Response
     */
    public function show(ChartAccount $chartAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChartAccount  $chartAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(ChartAccount $chartAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChartAccountRequest  $request
     * @param  \App\Models\ChartAccount  $chartAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChartAccountRequest $request, ChartAccount $chartAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChartAccount  $chartAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartAccount $chartAccount)
    {
        //
    }
}
