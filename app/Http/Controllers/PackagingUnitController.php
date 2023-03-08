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
        $units = PackagingUnit::query()->orderBy('id','DESC')->get();
        return view('admin.settings.packaging_units',compact('units'));
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
        $unit = new PackagingUnit();
        $unit->name=$request->name;
        $unit->is_active='1';
        $unit->save();
//        return $unit;
        return redirect()->back()->with('success','Packaging Unit Created Successfully');
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
        $unit = $packagingUnit::findOrFail($request->input('UnitId'));
        $unit->name=$request->name;
        $unit->is_active=$request->is_active;
        $unit->save();
        return redirect()->back()->with('success','Packaging Unit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackagingUnit  $packagingUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackagingUnit $packagingUnit,$id)
    {
        try {
            $unit = PackagingUnit::find($id);
            $unit->delete();
            return redirect()->back()->with('success','Packaging Unit deleted Successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('error','Packaging Unit can not be deleted Successfully');
        }
    }
}
