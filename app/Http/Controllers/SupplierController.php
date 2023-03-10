<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Operator;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $operators = Operator::all();
        $suppliers = Supplier::with('operator')->orderBy('id','DESC')->get();
        return view('admin.settings.suppliers',compact('suppliers','operators'));
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
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = new Supplier();
        $supplier->operator_id=$request->operator_id;
        $supplier->name=$request->name;
        $supplier->phone_number=$request->phone_number;
        $supplier->email=$request->email;
        $supplier->address=$request->address;
        $supplier->contact_name=$request->contact_name;
        $supplier->contact_email=$request->contact_email;
//        return $supplier;
        $supplier->save();
        return redirect()->back()->with('success','Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier = Supplier::findOrFail($request->input('SupplierId'));
        $supplier->operator_id=$request->operator_id;
        $supplier->name=$request->name;
        $supplier->phone_number=$request->phone_number;
        $supplier->email=$request->email;
        $supplier->address=$request->address;
        $supplier->contact_name=$request->contact_name;
        $supplier->save();
        return redirect()->back()->with('success','Supplier updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier,$id)
    {
        try {
            $supplier = Supplier::find($id);
            $supplier->delete();
            return redirect()->back()->with('success','Supplier deleted Successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('success','Supplier can not be deleted');
        }
    }
}
