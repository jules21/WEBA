<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackagingUnitRequest;
use App\Http\Requests\UpdatePackagingUnitRequest;
use App\Models\PackagingUnit;

class PackagingUnitController extends Controller
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
     * @param  \App\Http\Requests\StorePackagingUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackagingUnitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackagingUnit  $packagingUnit
     * @return \Illuminate\Http\Response
     */
    public function show(PackagingUnit $packagingUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackagingUnit  $packagingUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(PackagingUnit $packagingUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackagingUnitRequest  $request
     * @param  \App\Models\PackagingUnit  $packagingUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackagingUnitRequest $request, PackagingUnit $packagingUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackagingUnit  $packagingUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackagingUnit $packagingUnit)
    {
        //
    }
}
