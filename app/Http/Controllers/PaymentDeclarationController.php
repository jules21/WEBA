<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDeclarationDataTable;
use App\Models\PaymentDeclaration;
use Illuminate\Http\Request;

class PaymentDeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $query = PaymentDeclaration::with(['request', 'request.operator', 'request.operator.operationAreas', 'request.customer', 'paymentConfig', 'paymentConfig.paymentType']);
        $query->when($user->operationArea && $user->operationArea->id, function ($query) use ($user) {
            $query->whereHas('request', function ($query) use ($user) {
                $query->whereHas('operator', function ($query) use ($user) {
                    $query->whereHas('operationAreas', function ($query) use ($user) {
                        $query->where('id', $user->operationArea->id);
                    });
                });
            });
        });
        $query->when($user->operator && $user->operator->id, function ($query) use ($user) {
            $query->whereHas('request', function ($query) use ($user) {
                $query->where('operator_id', $user->operator->id);
            });
        });
        $datatable = new PaymentDeclarationDataTable($query);

        return $datatable->render('admin.payments.declarations');
    }

    public function history(PaymentDeclaration $paymentDeclaration)
    {
        $histories = $paymentDeclaration->paymentHistories;
        return view('admin.payments.histories', compact('paymentDeclaration', 'histories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentDeclaration  $paymentDeclaration
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentDeclaration $paymentDeclaration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentDeclaration  $paymentDeclaration
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentDeclaration $paymentDeclaration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentDeclaration  $paymentDeclaration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentDeclaration $paymentDeclaration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentDeclaration  $paymentDeclaration
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentDeclaration $paymentDeclaration)
    {
        //
    }
}
