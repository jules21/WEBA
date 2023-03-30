<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentMappingRequest;
use App\Http\Requests\UpdatePaymentMappingRequest;
use App\Models\PaymentConfiguration;
use App\Models\PaymentMapping;
use App\Models\PaymentServiceProvider;
use App\Models\PaymentServiceProviderAccount;
use Illuminate\Http\Request;

class PaymentMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($payment_configuration_id)
    {
//        $payment_configuration_id=decrypt($payment_configuration_id);

        $user = auth()->user();
        $banks = PaymentServiceProvider::with('accounts');
        $banks->when($user->operator_id, function ($query){
            $query->whereHas('accounts', function ($query){
                $query->whereHas('operationArea', function ($query){
                    $query->where('operator_id', auth()->user()->operator_id);
                });
            });
        });
        $banks->when($user->operation_area, function ($query){
            $query->whereHas('accounts', function ($query){
                $query->whereHas('operationArea', function ($query){
                    $query->where('id', auth()->user()->operation_area);
                });
            });
        });
        $banks = $banks->get();

        $paymentMappings = PaymentMapping::query()
            ->orderBy('id','DESC')
            ->with('account.paymentServiceProvider')
            ->where('payment_configuration_id',$payment_configuration_id)->get();
        $payment_configuration = PaymentConfiguration::find($payment_configuration_id);
        return view('admin.settings.payment_mappings',compact('paymentMappings','payment_configuration','banks'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePaymentMappingRequest $request,$payment_configuration_id)
    {
        $payment_configuration = PaymentConfiguration::find($payment_configuration_id);
        $paymentMapping = new PaymentMapping();
        $paymentMapping->payment_configuration_id=$payment_configuration->id;
        $paymentMapping->psp_account_id=$request->psp_account_id;
//        return $paymentMapping;
        $paymentMapping->save();
        return redirect()->back()->with('success','Payment Mapping Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMapping  $paymentMapping
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMapping $paymentMapping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMapping  $paymentMapping
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMapping $paymentMapping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMapping  $paymentMapping
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePaymentMappingRequest $request, PaymentMapping $paymentMapping)
    {
        $paymentMapping = PaymentMapping::findOrFail($request->input('MappingId'));
        $paymentMapping->psp_account_id=$request->psp_account_id;
        $paymentMapping->save();
        return redirect()->back()->with('success','Payment Mapping Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMapping  $paymentMapping
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PaymentMapping $paymentMapping,$id)
    {
        try {
            $paymentMapping = PaymentMapping::find($id);
            $paymentMapping->delete();
            return redirect()->back()->with('success','Payment Mapping deleted Successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('success','Payment Mapping can not be deleted');
        }
    }

    public function loadPspAccount($id){
        $pay_config_id = \request()->paymentConfigId;
        $pay_config = PaymentConfiguration::find($pay_config_id);
        $payment = PaymentServiceProviderAccount::query()
            ->where('payment_service_provider_id',$id)
            ->where('operation_area_id', $pay_config->operation_area_id)
            ->get();
        return response()->json($payment);
    }
}
