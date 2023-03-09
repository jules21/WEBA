<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePaymentConfiguration;
use App\Models\Operator;
use App\Models\PaymentConfiguration;
use Illuminate\Http\Request;

class PaymentConfigurationController extends Controller
{
    public function index(){
        $user = auth()->user();
             if ($user->is_super_admin){
                 $payments = PaymentConfiguration::query()->with('paymentType','requestType','operator','operationArea')->orderBy('id','DESC')->get();
                 $operators = Operator::all();
             }else{
                 $payments = PaymentConfiguration::query()->with('paymentType','requestType','operator','operationArea')
                     ->orderBy('id','DESC')
                     ->where('operator_id',$user->operator_id)->get();
                 $operators = Operator::all();
             }

        return view('admin.settings.payment_configurations',compact('payments','operators'));
    }

    public function store(Request $request){

//        $request->validated();
        $payment = new PaymentConfiguration();
        $payment->payment_type_id=$request->payment_type_id;
        $payment->request_type_id=$request->request_type_id;
        $payment->operator_id=$request->operator_id;
        $payment->operation_area_id=$request->operation_area_id;
        $payment->amount=$request->amount;
//        return $payment;
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

        try {
            $payment = PaymentConfiguration::find($id);
            $payment->delete();
            return redirect()->back()->with('success','Payment Configuration deleted successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('success','Payment Configuration can not be deleted');
        }
    }
}
