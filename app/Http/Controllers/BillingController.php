<?php

namespace App\Http\Controllers;

use App\DataTables\BillingDataTable;
use App\Exports\BillingExport;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillingController extends Controller
{
    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operator_id = request()->operator_id;
        $operation_area_id = request()->operation_area_id;
        $customer_field_officer_id = request()->customer_field_officer_id;
        $customer_field_officer = User::query()->find($customer_field_officer_id);

        //filter data based on user role
        $user = auth()->user();
        $query = Billing::query()->with(['meterRequest', 'meterRequest.request', 'meterRequest.request.operator',
             'user', 'meterRequest.request.customer']);
        $query->when($user->operation_area, function ($query) use ($user) {
            $query->whereHas('meterRequest', function ($query) use ($user) {
                $query->whereHas('request', function ($query) use ($user) {
                    $query->where('operation_area_id', $user->operation_area);
                });
            });
        });
        $query->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('meterRequest', function ($query) use ($user) {
                $query->whereHas('request', function ($query) use ($user) {
                    $query->where('operator_id', $user->operator_id);
                });
            });
        });

        $customerFieldOfficers = User::has('bills');

        $customerFieldOfficers->when($customer_field_officer_id, function ($query) {
            $query->whereHas('bills', function ($query) {
                $query->whereHas('meterRequest', function ($query) {
                    $query->whereHas('request', function ($query) {
                        $query->whereIn('operation_area_id', request()->customer_field_officer_id);
                    });
                });
            });
        });

//        here officer area are not filtered based on selected operation area
        $operatorOfficer = User::query();
        $operatorOfficer->when($user->operation_area, function ($query) use ($user) {
            $query->whereHas('bills', function ($query) use ($user) {
                $query->whereHas('meterRequest', function ($query) use ($user) {
                    $query->whereHas('request', function ($query) use ($user) {
                        $query->where('operation_area_id', $user->operation_area);
                    });
                });
            });
        });
//        $customerFieldOfficers->when($user->operator_id, function ($query) use ($user) {
//            $query->whereHas('bills', function ($query) use ($user) {
//                $query->whereHas('meterRequest', function ($query) use ($user) {
//                    $query->whereHas('request', function ($query) use ($user) {
//                        $query->where('operator_id', $user->operator_id);
//                    });
//                });
//            });
//        });

        //filter data based on request

        //operator_id
        $query->when(request()->has('operator_id'), function ($query) {
            $query->whereHas('meterRequest', function ($query) {
                $query->whereHas('request', function ($query) {
                    $query->where('operator_id', request()->operator_id);
                });
            });
        });
        //operation_area_id
        $query->when(request()->has('operation_area_id'), function ($query) {
            $query->whereHas('meterRequest', function ($query) {
                $query->whereHas('request', function ($query) {
                    $query->whereIn('operation_area_id', request()->operation_area_id);
                });
            });
        });
        //customer_field_officer_id
        $query->when(request()->has('customer_field_officer_id'), function ($query) {
            $query->whereIn('user_id', request()->customer_field_officer_id);
        });
        //meter_number
        $query->when(request()->has('meter_number'), function ($query) {
            $query->where('meter_number', 'like', '%' . request()->meter_number . '%');
        });
        //subscription_number
        $query->when(request()->has('subscription_number'), function ($query) {
            $query->where('subscription_number', 'like', '%' . request()->subscription_number . '%');
        });

        //from date
        $query->when((request()->has('from_date') && request()->filled('from_date')), function ($query) {
            $query->whereDate('created_at', '>=', request()->from_date);
        });
        //to date
        $query->when((request()->has('to_date') && request()->filled('to_date')), function ($query) {
            $query->whereDate('created_at', '<=', request()->to_date);
        });





        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportBilling($query->get());
        }

        $datatable = new BillingDataTable($query);
        return $datatable->render('admin.billings.index',
            [
                'operators' => Operator::query()->get(),
                'operationAreas' => $user->operator_id ?
                    OperationArea::query()->where('operator_id', $user->operator_id)->get()
                    : [],
                'customerFieldOfficers' =>
                    (\request()->operation_area_id ? $customerFieldOfficers->get() : $user->operation_area) ? $operatorOfficer->get() : [],
                'operator_id' => $operator_id,
                'operation_area_id' => $operation_area_id,
                'customer_field_officer_id' => $customer_field_officer_id,

            ]);
    }

    public function show(Billing $billing)
    {
        return view('admin.billings._details', compact('billing'));
    }

    public function customerBillings(Customer $customer)
    {
        $billings = Billing::query()->whereHas('meterRequest', function ($query) use ($customer) {
            $query->whereHas('request', function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);
            });
        });
        $datatable = new BillingDataTable($billings);
        return $datatable->render('admin.billings.customer_bills', compact('customer'));
    }

    // meter billings
    public function meterBillings($meter, $subscription)
    {
        $billings = Billing::query()->where('meter_number', $meter)->where('subscription_number', $subscription);
        $datatable = new BillingDataTable($billings);
        return $datatable->render('admin.billings.customer_bills', compact('meter'));
    }

    public function download(Billing $billing)
    {
        if ($billing->attachment)
            return $this->downloadFile($billing->attachment);
        return redirect()->back()->with('error', 'No file found');
    }

    public function exportBilling($query)
    {
        return Excel::download(new BillingExport($query), 'Billing List.xlsx');
    }

    public function history(Billing $billing)
    {
        $history = $billing->history()->get();
        return view('admin.billings.history', compact('history'));
    }

}
