<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use App\Http\Requests\ValidatePaymentType;
use App\Models\PaymentType;
use App\Models\Request;
use App\Models\User;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = PaymentType::query()->orderBy('id','DESC')->get();
        return view('admin.settings.payment_types',compact('types'));
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
     * @param  \App\Http\Requests\StorePaymentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidatePaymentType $request)
    {
        $request->validated();
        $type = new PaymentType();
        $type->name=$request->name;
        $type->name_kin=$request->name_kin;
        $type->is_active="1";
//        return $type;
        $type->save();
        return redirect()->back()->with('success', 'Payment Type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentType $paymentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentTypeRequest  $request
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentTypeRequest $request, PaymentType $paymentType)
    {
        $type = PaymentType::FindOrFail($request->input('TypeId'));
        $type->name=$request->name;
        $type->name_kin=$request->name_kin;
        $type->is_active=$request->is_active;
//        return $type;
        $type->save();
        return redirect()->back()->with('success','Payment Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $paymentType,$id)
    {
        try {
            $type = PaymentType::find($id);
            $type->delete();
            return redirect()->back()->with('success','Payment Type deleted successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('error','Payment Type can not be deleted successfully');
        }
    }
}
