<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestTypeRequest;
use App\Http\Requests\UpdateRequestTypeRequest;
use App\Http\Requests\ValidateRequestType;
use App\Models\PaymentType;
use App\Models\RequestType;

class RequestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = RequestType::query()->orderBy('id','DESC')->get();
        return view('admin.settings.request_types',compact('types'));
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
     * @param  \App\Http\Requests\ValidateRequestType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateRequestType $request)
    {
                $request->validated();
        $type = new RequestType();
        $type->name=$request->name;
        $type->name_kin=$request->name_kin;
        $type->is_active="1";
//        return $type;
        $type->save();
        return redirect()->back()->with('success', 'Request Type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestType  $requestType
     * @return \Illuminate\Http\Response
     */
    public function show(RequestType $requestType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestType  $requestType
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestType $requestType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestTypeRequest  $request
     * @param  \App\Models\RequestType  $requestType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestTypeRequest $request, RequestType $requestType)
    {
        $type = RequestType::FindOrFail($request->input('TypeId'));
        $type->name=$request->name;
        $type->name_kin=$request->name_kin;
        $type->is_active=$request->is_active;
//        return $type;
        $type->save();
        return redirect()->back()->with('success','Request Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestType  $requestType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestType $requestType,$id)
    {
        try {
            $type = RequestType::find($id);
            $type->delete();
            return redirect()->back()->with('success','Request Type deleted successfully');
        }catch (\Exception $exception){
          info($exception);
            return redirect()->back()->with('success','Request Type deleted successfully');
        }
    }
}
