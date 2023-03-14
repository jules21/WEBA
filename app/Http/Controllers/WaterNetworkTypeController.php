<?php

namespace App\Http\Controllers;

use App\Models\WaterNetworkType;
use Illuminate\Http\Request;

class WaterNetworkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = WaterNetworkType::query()->orderBy('id','DESC')->get();
        return view('admin.settings.water_network_types',compact('types'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new WaterNetworkType();
        $type->name=$request->name;
        $type->save();
        return redirect()->back()->with('sucess','Water Network Type Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterNetworkType  $waterNetworkType
     * @return \Illuminate\Http\Response
     */
    public function show(WaterNetworkType $waterNetworkType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterNetworkType  $waterNetworkType
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterNetworkType $waterNetworkType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaterNetworkType  $waterNetworkType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaterNetworkType $waterNetworkType)
    {
        $type =  WaterNetworkType::findOrFail($request->input('WaterNetworkTypeId'));
        $type->name=$request->name;
        $type->save();
        return redirect()->back()->with('sucess','Water Network Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterNetworkType  $waterNetworkType
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterNetworkType $waterNetworkType,$id)
    {
        try {
            $type = WaterNetworkType::find($id);
            $type->delete();
            return redirect()->back()->with('sucess','Water Network Type Deleted Successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('error','Water Network Type Can not be deleted');
        }
    }
}
