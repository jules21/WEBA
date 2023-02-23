<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaOfOperationRequest;
use App\Http\Requests\UpdateAreaOfOperationRequest;
use App\Models\AreaOfOperation;

class AreaOfOperationController extends Controller
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
     * @param  \App\Http\Requests\StoreAreaOfOperationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaOfOperationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AreaOfOperation  $areaOfOperation
     * @return \Illuminate\Http\Response
     */
    public function show(AreaOfOperation $areaOfOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaOfOperation  $areaOfOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaOfOperation $areaOfOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAreaOfOperationRequest  $request
     * @param  \App\Models\AreaOfOperation  $areaOfOperation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaOfOperationRequest $request, AreaOfOperation $areaOfOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaOfOperation  $areaOfOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaOfOperation $areaOfOperation)
    {
        //
    }
}
