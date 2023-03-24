<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterNetworkRequest;
use App\Http\Requests\UpdateWaterNetworkRequest;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\WaterNetwork;
use App\Models\User;

class WaterNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::all();
        $waterNetworks = WaterNetwork::with('operator','waterNetworkType','operationArea','waterNetworkStatus')->orderBy('id','DESC')->get();
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreWaterNetworkRequest $request)
    {
        $waterNetwork = new WaterNetwork();
        $waterNetwork->name=$request->name;
        $waterNetwork->distance_covered=$request->distance_covered;
        $waterNetwork->population_covered=$request->population_covered;
        $waterNetwork->water_network_type_id=$request->water_network_type_id;
        $waterNetwork->operation_area_id=$request->operation_area_id;
        $waterNetwork->water_network_status_id=$request->water_network_status_id;
        if (auth()->user()->is_super_admin == "true")
            $waterNetwork->operator_id=$request->operator_id;
        else
            $waterNetwork->operator_id=auth()->user()->operator_id;
//        return $waterNetwork;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWaterNetworkRequest $request, WaterNetwork $waterNetwork)
    {
        $waterNetwork = WaterNetwork::find($request->input('WaterNetworkId'));
        $waterNetwork->name=$request->name;
        $waterNetwork->distance_covered=$request->distance_covered;
        $waterNetwork->population_covered=$request->population_covered;
        $waterNetwork->water_network_type_id=$request->water_network_type_id;
        $waterNetwork->operation_area_id=$request->operation_area_id;
        $waterNetwork->water_network_status_id=$request->water_network_status_id;
        if (auth()->user()->is_super_admin == "true")
            $waterNetwork->operator_id=$request->operator_id;
        else
            $waterNetwork->operator_id=auth()->user()->operator_id;
//        return $waterNetwork;
        $waterNetwork->save();
        return redirect()->back()->with('success','Water Network updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterNetwork  $waterNetwork
     * @return \Illuminate\Http\RedirectResponse
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

    public function loadAreaOperation($id){
        $areas = OperationArea::where('operator_id',$id)->get();
        return response()->json($areas);
    }
}
