<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterNetworkStatusRequest;
use App\Http\Requests\UpdateWaterNetworkStatusRequest;
use App\Models\WaterNetworkStatus;

class WaterNetworkStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = WaterNetworkStatus::query()->orderBy('id', 'DESC')->get();

        return view('admin.settings.water_network_statuses', compact('statuses'));
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
    public function store(StoreWaterNetworkStatusRequest $request)
    {
        $status = new WaterNetworkStatus();
        $status->name = $request->name;
        $status->save();

        return redirect()->back()->with('success', 'Water Network Status Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(WaterNetworkStatus $waterNetworkStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterNetworkStatus $waterNetworkStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWaterNetworkStatusRequest $request, WaterNetworkStatus $waterNetworkStatus)
    {
        $status = WaterNetworkStatus::findOrFail($request->input('WaterNetworkStatusId'));
        $status->name = $request->name;
        $status->save();

        return redirect()->back()->with('success', 'Water Network Status Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(WaterNetworkStatus $waterNetworkStatus, $id)
    {
        $status = WaterNetworkStatus::find($id);
        $status->delete();

        return redirect()->back()->with('success', 'Water Network Status Updated Successfully');
    }
}
