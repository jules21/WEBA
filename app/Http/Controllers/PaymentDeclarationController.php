<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDeclarationDataTable;
use App\Exports\PaymentExport;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\PaymentDeclaration;
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
        $operator_id = request()->operator_id;
        $operation_area_id = request()->operation_area_id;

        $user = auth()->user();
        $query = PaymentDeclaration::with(['request.requestType', 'request.operator', 'request.operator.operationAreas', 'request.customer', 'paymentConfig', 'paymentConfig.paymentType']);
        $query->when($user->operationArea && $user->operationArea->id,
            function ($query) use ($user) {
            $query->whereHas('request', function ($query) use ($user) {
                $query->whereHas('operator', function ($query) use ($user) {
                    $query->whereHas('operationAreas', function ($query) use ($user) {
                        $query->where('id', $user->operationArea->id);
                    });
                });
            });
        });
        $query->when($user->operator && $user->operator->id,
            function ($query) use ($user) {
            $query->whereHas('request', function ($query) use ($user) {
                $query->where('operator_id', $user->operator->id);
            });
        });

        //operator_id
        $query->when((request()->has('operator_id') && request()->filled('operator_id'))
            , function ($query) {
                    $query->whereHas('request', function ($query) {
                        $query->where('operator_id', request()->operator_id);
                    });
            });
        //operation_area_id
        $query->when((request()->has('operation_area_id') && request()->filled('operation_area_id'))
            , function ($query) {
                    $query->whereHas('request', function ($query) {
                        $query->whereIn('operation_area_id', request()->operation_area_id);
                    });

            });
        //reference_number
        $query->when((request()->has('reference_number') && request()->filled('reference_number'))
            , function ($query) {
                $query->where('payment_reference', 'like', '%' . request()->reference_number . '%');
            });
        //from date
        $query->when((request()->has('from_date') && request()->filled('from_date')),
            function ($query) {
            $query->whereDate('created_at', '>=', request()->from_date);
        });
        //to date
        $query->when((request()->has('to_date') && request()->filled('to_date')),
            function ($query) {
            $query->whereDate('created_at', '<=', request()->to_date);
        });
        //payment_type_id
        $query->when((request()->has('payment_type') && request()->filled('payment_type'))
            , function ($query) {
                $query->whereHas('paymentConfig', function ($query) {
                    $query->where('payment_type_id', request()->payment_type);
                });
            });
        //request_type_id
        $query->when((request()->has('request_type') && request()->filled('request_type'))
            , function ($query) {
                    $query->whereHas('request', function ($query) {
                        $query->where('request_type_id', request()->request_type);
                    });
            });
        //status
        $query->when((request()->has('status') && request()->filled('status'))
            , function ($query) {
                $query->where('status', request()->status);
            });

        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportPayment($query->get());
        }

        $datatable = new PaymentDeclarationDataTable($query);

        return $datatable->render('admin.payments.declarations',
            [
                'operators' => Operator::query()->get(),
                'operationAreas' => $user->operator_id ?
                    OperationArea::query()->where('operator_id', $user->operator_id)->get()
                    : [],
                'operator_id' => $operator_id,
                'operation_area_id' => $operation_area_id,
            ]
        );
    }
    public function history(PaymentDeclaration $paymentDeclaration)
    {
        $paymentDeclaration->load('paymentHistories', 'paymentHistories.paymentDeclaration');

        $histories = $paymentDeclaration->paymentHistories;
        return view('admin.payments.histories', compact('paymentDeclaration', 'histories'));
    }
    public function exportPayment($query)
    {
        return Excel::download(new PaymentExport($query), 'Payment List.xlsx');
    }
}
