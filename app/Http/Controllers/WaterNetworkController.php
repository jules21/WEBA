<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterNetworkRequest;
use App\Http\Requests\UpdateWaterNetworkRequest;
use App\Models\Operator;
use App\Models\WaterNetwork;

class WaterNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::all();
        $waterNetworks = WaterNetwork::query()->orderBy('id','DESC')->get();
        return view('admin.settings.water_networks',compact('waterNetworks','operators'));
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
     * @param  \App\Http\Requests\StoreWaterNetworkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaterNetworkRequest $request)
    {
        $waterNetwork = new WaterNetwork();
        $waterNetwork->name=$request->name;
        $waterNetwork->distance_covered=$request->distance_covered;
        $waterNetwork->population_covered=$request->population_covered;
        $waterNetwork->operator_id=$request->operator_id;
        $waterNetwork->save();
        return redirect()->back()->with('success','Water Network created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterNetwork  $waterNetwork
     * @return \Illuminate\Http\Response
     */
    public function show(WaterNetwork $waterNetwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterNetwork  $waterNetwork
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterNetwork $waterNetwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWaterNetworkRequest  $request
     * @param  \App\Models\WaterNetwork  $waterNetwork
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaterNetworkRequest $request, WaterNetwork $waterNetwork)
    {
        $waterNetwork = WaterNetwork::find($request->input('WaterNetworkId'));
        $waterNetwork->name=$request->name;
        $waterNetwork->distance_covered=$request->distance_covered;
        $waterNetwork->population_covered=$request->population_covered;
        $waterNetwork->operator_id=$request->operator_id;
        $waterNetwork->save();
        return redirect()->back()->with('success','Water Network updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterNetwork  $waterNetwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterNetwork $waterNetwork,$id)
    {
        try {
            $waterNetwork= WaterNetwork::find($id);
            $waterNetwork->delete();
            return redirect()->back()->with('success','Water Network deleted Successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('error','Water Network can not be deleted Successfully');
        }
    }
}
