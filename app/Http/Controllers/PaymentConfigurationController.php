<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePaymentConfiguration;
use App\Http\Requests\ValidateRequestDurationConfiguration;
use App\Models\Operator;
use App\Models\PaymentConfiguration;
use App\Models\RequestDurationConfiguration;
use Illuminate\Http\Request;

class PaymentConfigurationController extends Controller
{
    public function index(){
        $payments = PaymentConfiguration::query()->orderBy('id','DESC')->get();
        $operators = Operator::all();
        return view('admin.settings.payment_configurations.index',compact('payments','operators'));
    }

    public function store(ValidatePaymentConfiguration $request){

        $request->validated();
        $payment = new PaymentConfiguration();
        $payment->payment_type_id=$request->payment_type_id;
        $payment->request_type_id=$request->request_type_id;
        $payment->operator_id=$request->operator_id;
        $payment->operation_area=$request->operation_area;
        $payment->amount=$request->amount;
        return $payment;
        $payment->save();
        return redirect()->back()->with('success','Payment Configuration created successfully');
    }

    public function update(ValidatePaymentConfiguration $request){

        $payment = PaymentConfiguration::FindOrFail($request->input('PaymentId'));
        $payment->payment_type_id=$request->payment_type_id;
        $payment->request_type_id=$request->request_type_id;
        $payment->operator_id=$request->operator_id;
        $payment->operation_area=$request->operation_area;
        $payment->amount=$request->amount;
        $payment->save();
        return redirect()->back()->with('success','Payment Configuration updated successfully');
    }

    public function destroy($id){

        $payment = PaymentConfiguration::find($id);
        $payment->delete();
        return redirect()->back()->with('success','Payment Configuration deleted successfully');
    }
}
