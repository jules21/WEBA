<?php

namespace App\Http\Controllers;

use App\Exports\PaymentConfigurationExport;
use App\Http\Requests\ValidatePaymentConfiguration;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\PaymentConfiguration;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PaymentConfigurationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $operation_area_id = request('operation_area_id');
        if ($user->is_super_admin) {
            $startDate = request('start_date');
            $endDate = request('end_date');
            $payment_type_id = request('payment_type_id');

            $payments = PaymentConfiguration::query()->with('paymentType', 'requestType', 'operator', 'operationArea')
                ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                    $builder->whereDate('created_at', '>=', $startDate);
                })
                ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                    $builder->whereDate('created_at', '<=', $endDate);
                })
                ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                    $builder->whereIn('operation_area_id', $operation_area_id);
                })
                ->when(!empty($payment_type_id), function (Builder $builder) use ($payment_type_id) {
                    $builder->where('payment_type_id', $payment_type_id);
                })
                ->orderBy('id', 'DESC')
                ->get();
            $operators = Operator::all();
        } else {
            $payments = PaymentConfiguration::query()->with('paymentType', 'requestType', 'operator', 'operationArea')
                ->orderBy('id', 'DESC')
                ->where('operator_id', $user->operator_id)->get();
            $operators = Operator::all();
        }
        $operationAreas = OperationArea::query()
            ->findMany($operation_area_id);

        return view('admin.settings.payment_configurations', compact('payments', 'operators', 'operationAreas'));
    }

    public function store(ValidatePaymentConfiguration $request)
    {

//        $request->validated();
        $payment = new PaymentConfiguration();
        $payment->payment_type_id = $request->payment_type_id;
        $payment->request_type_id = $request->request_type_id;
        $payment->operator_id = $request->operator_id;
        $payment->operation_area_id = $request->operation_area_id;
        $payment->amount = $request->amount;
//        return $payment;
        $payment->save();
        return redirect()->back()->with('success', 'Payment Configuration created successfully');
    }

    public function update(ValidatePaymentConfiguration $request)
    {

        $payment = PaymentConfiguration::FindOrFail($request->input('PaymentId'));
        $payment->payment_type_id = $request->payment_type_id;
        $payment->request_type_id = $request->request_type_id;
        $payment->operator_id = $request->operator_id;
        $payment->operation_area_id = $request->operation_area_id;
        $payment->amount = $request->amount;
        $payment->save();
        return redirect()->back()->with('success', 'Payment Configuration updated successfully');
    }

    public function destroy($id)
    {

        try {
            $payment = PaymentConfiguration::find($id);
            $payment->delete();
            return redirect()->back()->with('success', 'Payment Configuration deleted successfully');
        } catch (\Exception $exception) {
            info($exception);
            return redirect()->back()->with('success', 'Payment Configuration can not be deleted');
        }
    }

    public function loadAreaOperation($id)
    {
        $areas = OperationArea::where('operator_id', $id)->get();
        return response()->json($areas);
    }

    public function export()
    {
        return \Excel::download(new PaymentConfigurationExport(), 'payment-configuration.xlsx');
    }
}
