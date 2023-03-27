<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDeclarationDataTable;
use App\Exports\BillingExport;
use App\Exports\PaymentExport;
use App\Models\PaymentDeclaration;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $query = PaymentDeclaration::with(['request.requestType', 'request.operator', 'request.operator.operationAreas', 'request.customer', 'paymentConfig', 'paymentConfig.paymentType']);
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

        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportPayment($query->get());
        }

        $datatable = new PaymentDeclarationDataTable($query);

        return $datatable->render('admin.payments.declarations');
    }

    public function history(PaymentDeclaration $paymentDeclaration)
    {
        $histories = $paymentDeclaration->paymentHistories;
        return view('admin.payments.histories', compact('paymentDeclaration', 'histories'));
    }
    public function exportPayment($query)
    {
        return Excel::download(new PaymentExport($query), 'Payment List.xlsx');
    }
}
