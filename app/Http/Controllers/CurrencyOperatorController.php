<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyOperatorRequest;
use App\Http\Requests\UpdateCurrencyOperatorRequest;
use App\Models\CurrencyOperator;

class CurrencyOperatorController extends Controller
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
     * @param  \App\Http\Requests\StoreCurrencyOperatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrencyOperatorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CurrencyOperator  $currencyOperator
     * @return \Illuminate\Http\Response
     */
    public function show(CurrencyOperator $currencyOperator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CurrencyOperator  $currencyOperator
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrencyOperator $currencyOperator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCurrencyOperatorRequest  $request
     * @param  \App\Models\CurrencyOperator  $currencyOperator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencyOperatorRequest $request, CurrencyOperator $currencyOperator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CurrencyOperator  $currencyOperator
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrencyOperator $currencyOperator)
    {
        //
    }
}
