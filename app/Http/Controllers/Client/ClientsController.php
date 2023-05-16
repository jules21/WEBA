<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeClientPasswordRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Middleware\RedirectIfNotClient;
use App\Models\Billing;
use App\Models\Client;
use App\Models\CustomerOverview;
use App\Models\District;
use App\Models\Faq;
use App\Models\MeterRequest;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Request;
use App\Models\Sector;
use App\Models\UserManual;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use LaravelIdea\Helper\App\Models\_IH_Sector_C;
use LaravelIdea\Helper\App\Models\_IH_Sector_QB;

class ClientsController extends Controller
{
    public function home()
    {
        $districts = District::query()
            ->whereHas('operationAreas')
            ->orderBy('name')
            ->get();

        $docNumber = auth('client')->user()->doc_number;

        $totalRequests = Request::whereHas('customer', function (Builder $query) use ($docNumber) {
            $query->where('doc_number', $docNumber);
        })->count();

        $totalWaterConnections = MeterRequest::whereHas('request.customer', function (Builder $query) use ($docNumber) {
            $query->where('doc_number', $docNumber);
        })->count();

        $totalAmountDue = Billing::whereHas('meterRequest.request.customer', function (Builder $query) use ($docNumber) {
            $query->where('doc_number', $docNumber);
        })->sum('balance');


        $operatorData = Operator::select('operators.name', DB::raw('SUM(billings.balance) as total_balance'), 'billings.subscription_number')
            ->join('requests', 'operators.id', '=', 'requests.operator_id')
            ->join('meter_requests', 'requests.id', '=', 'meter_requests.request_id')
            ->join('billings', 'meter_requests.subscription_number', '=', 'billings.subscription_number')
            ->join('customers', 'operators.id', '=', 'customers.operator_id')
            ->where(DB::raw("customers.doc_number"), "=",$docNumber )
            ->groupBy('billings.subscription_number', 'operators.name')
            ->get();




        $customerOverview = new CustomerOverview($totalRequests, $totalWaterConnections, $totalAmountDue);

        return view('client.home', [
            'districts' => $districts,
            'customerOverview' => $customerOverview,
            'operatorData' => $operatorData
        ]);
    }

    public function requests()
    {
        $recentRequests = Request::with(['requestType', 'operator'])
            ->whereHas('customer', function (Builder $builder) {
                $builder->where('doc_number', '=', auth('client')->user()->doc_number);
            })
            ->when(request('op', 0), function (Builder $builder) {
                $builder->where('operator_id', '=', request('op'));
            })
            ->latest()
            ->limit(10)
            ->paginate()
            ->withQueryString();
        return view('client.requests', [
            'recentRequests' => $recentRequests
        ]);
    }


    public function profile()
    {
        return view('client.profile');
    }

    public function updateProfile(Request $request, Client $client)
    {
        dd($request->all()->toArray());
    }

    public function updatePassword(ChangeClientPasswordRequest $request)
    {
        auth('client')->user()->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function help()
    {
        $userManuals = UserManual::query()
            ->latest()
            ->paginate(10);
        return view('client.help', [
            'userManuals' => $userManuals
        ]);
    }

    public function faq()
    {
        $faqs = Faq::query()
            ->latest()
            ->paginate(10);
        return view('client.faq', [
            'faqs' => $faqs
        ]);
    }

}
