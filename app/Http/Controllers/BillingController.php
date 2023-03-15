<?php

namespace App\Http\Controllers;

use App\DataTables\BillingDataTable;
use App\Models\Billing;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //filter data based on user role
        $user = auth()->user();
        $query = Billing::query()->with(['meterRequest', 'meterRequest.request', 'meterRequest.request.operator',
            'meterRequest.request.operationArea', 'user', 'meterRequest.request.customer']);
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
        $customerFieldOfficers->when($user->operation_area, function ($query) use ($user) {
            $query->whereHas('bills', function ($query) use ($user) {
                $query->whereHas('meterRequest', function ($query) use ($user) {
                    $query->whereHas('request', function ($query) use ($user) {
                        $query->where('operation_area_id', $user->operation_area);
                    });
                });
            });
        });
        $customerFieldOfficers->when($user->operator_id, function ($query) use ($user) {
            $query->whereHas('bills', function ($query) use ($user) {
                $query->whereHas('meterRequest', function ($query) use ($user) {
                    $query->whereHas('request', function ($query) use ($user) {
                        $query->where('operator_id', $user->operator_id);
                    });
                });
            });
        });

        //filter data based on request

        //operator_id
        $query->when(request()->has('operator_id'), function ($query) {
            $query->whereHas('meterRequest', function ($query) {
                $query->whereHas('request', function ($query) {
                    $query->whereIn('operator_id', request()->operator_id);
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

        $datatable = new BillingDataTable($query);
        return $datatable->render('admin.billings.index',
            [
                'operators' => Operator::query()->get(),
                'operationAreas' => $user->operator_id ?
                    OperationArea::query()->where('operator_id', $user->operator_id)->get()
                    : OperationArea::query()->get(),
                'customerFieldOfficers' => $customerFieldOfficers->get()
            ]);
    }

    public function show(Billing $billing)
    {
        return view('admin.billings._details', compact('billing'));
    }

}
