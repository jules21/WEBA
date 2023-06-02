<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterNetworkRequest;
use App\Http\Requests\StoreWaterNetworkTypeRequest;
use App\Http\Requests\UpdateWaterNetworkTypeRequest;
use App\Models\WaterNetworkType;
use Illuminate\Http\Request;

class WaterNetworkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $types = WaterNetworkType::query()->orderBy('id', 'DESC')->get();

        return view('admin.settings.water_network_types', compact('types'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreWaterNetworkTypeRequest $request)
    {
        $type = new WaterNetworkType();
        $type->name = $request->name;
        $type->unit_price = $request->unit_price;
        $type->save();

        return redirect()->back()->with('sucess', 'Water Network Type Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(WaterNetworkType $waterNetworkType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterNetworkType $waterNetworkType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWaterNetworkTypeRequest $request, WaterNetworkType $waterNetworkType)
    {
        $type = WaterNetworkType::findOrFail($request->input('WaterNetworkTypeId'));
        $type->name = $request->name;
        $type->unit_price = $request->unit_price;
        $type->save();

        return redirect()->back()->with('sucess', 'Water Network Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(WaterNetworkType $waterNetworkType, $id)
    {
        try {
            $type = WaterNetworkType::find($id);
            $type->delete();

            return redirect()->back()->with('sucess', 'Water Network Type Deleted Successfully');
        } catch (\Exception $exception) {
            info($exception);

            return redirect()->back()->with('error', 'Water Network Type Can not be deleted');
        }
    }
}
