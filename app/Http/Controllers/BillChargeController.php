<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillChargeRequest;
use App\Http\Requests\UpdateBillChargeRequest;
use App\Models\BillCharge;

class BillChargeController extends Controller
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
     * @param  \App\Http\Requests\StoreBillChargeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillChargeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillCharge  $billCharge
     * @return \Illuminate\Http\Response
     */
    public function show(BillCharge $billCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillCharge  $billCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(BillCharge $billCharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillChargeRequest  $request
     * @param  \App\Models\BillCharge  $billCharge
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillChargeRequest $request, BillCharge $billCharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillCharge  $billCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillCharge $billCharge)
    {
        //
    }
}
