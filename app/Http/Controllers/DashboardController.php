<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\MeterRequest;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Payment;
use App\Models\Request;
use App\Models\Stock;
use App\Models\WaterNetwork;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->level2Dashboard();
    }



    /**
     * level2Dashboard is for user with operator and no operation area
     */
    public function level2Dashboard()
    {
        $totalOperationAreas = OperationArea::where('operator_id', auth()->user()->operator_id)->count('district_id');
        $totalMeters = MeterRequest::query()
            ->whereHas('request', function ($query) {
                $query->where('operator_id', auth()->user()->operator_id);
            })->count();
        $totalCustomers = Customer::where('operator_id', auth()->user()->operator_id)
            ->wherehas('connections')->count('doc_number');
        $waterNetworks = 0;
        $requests = Request::query()
            ->where('operator_id', auth()->user()->operator_id)->get(['id', 'status']);
        $allRequests = $requests->count();
        $rejectRequests = $requests->whereIn('status', [Status::REJECTED,
            Status::CANCELLED])->count();
        $approveRequests = Request::query()->whereIn('status', [
            Status::APPROVED,
            Status::DELIVERED,
            Status::PARTIALLY_DELIVERED,
            Status::METER_ASSIGNED,])->count();
        $pendingRequests = $requests->whereIn('status', [Status::PENDING])->count();

        $consumptionPerMonth = $this->getConsumedWater();
        $topOperators = $this->getTopWaterNetWorks();
        $consumerPerOperators = $this->getOperatorConsumers();
        $billingsPerMonth = $this->getBillingPerMonth();

        return view('admin.dashboard.level2',
            compact('waterNetworks', 'totalOperationAreas',
                'totalMeters', 'totalCustomers', 'consumptionPerMonth',
                'topOperators', 'consumerPerOperators',
                'rejectRequests', 'approveRequests', 'pendingRequests', 'allRequests',
                'billingsPerMonth'));
    }


    private function getConsumedWater()
    {
        $operatorId = auth()->user()->operator_id;
        $operationAreaId = auth()->user()->operation_area_id;
        $billings = Billing::query()
            ->when(auth()->user()->district_id, function ($query) {
                return $query->whereHas('meterRequest.request', function ($query) {
                    return $query->where('district_id', auth()->user()->district_id);
                });
            })->when($operatorId, function ($query) use ($operatorId) {
                return $query->whereHas('meterRequest.request', function ($query) use ($operatorId) {
                    return $query->where('operator_id', $operatorId);
                });
            })->when($operationAreaId, function ($query) use ($operationAreaId) {
                return $query->whereHas('meterRequest.request', function ($query) use ($operationAreaId) {
                    return $query->where('operation_area_id', $operationAreaId);
                });
            })->select(\DB::raw('sum(last_index-starting_index) as consumed_water, extract("MONTH" FROM created_at) as month'))
            ->groupByRaw('extract("MONTH" FROM created_at)')
            ->get();
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $water = $billings->where('month', $i)->first();
            $monthShortName = date('M', mktime(0, 0, 0, $i, 10));
            $data[$monthShortName] = floatval($water->consumed_water ?? 0) ?? 0;
        }

        return $data;
    }

    private function getOperatorConsumers()
    {
        $customers = Customer::query()
            ->whereHas('connections', function ($query) {
                $query->whereHas('request', function ($query) {
                    $query->when(auth()->user()->district_id, function ($query) {
                        return $query->where('district_id', auth()->user()->district_id);
                    });
                });
            })
            ->join('operators', 'operators.id', '=', 'customers.operator_id')
            ->select(\DB::raw('count(operators.id) as total,operators.name,customers.operator_id'))
            ->groupBy('customers.operator_id', 'operators.name')
            ->get();
        $data = [];

        $operators = Operator::all();
        foreach ($operators as $operator) {
            $total = $customers->where('operator_id', $operator->id)->sum('total');
            $data[$operator->name] = $total;
        }

        return $data;
    }

    private function getTopWaterNetWorks()
    {
        $operatorId = auth()->user()->operator_id;
        $operationAreaId = auth()->user()->operation_area;
        $waterNetworks = WaterNetwork::query()
            ->join('requests', 'requests.water_network_id', '=', 'water_networks.id')
//            ->join('meter_requests', 'meter_requests.request_id', '=', 'requests.id')
//            ->join('billings', 'billings.subscription_number', '=', 'meter_requests.subscription_number')
//            ->join('operation_areas', 'operation_areas.id', '=', 'requests.operation_area_id')
//            ->join('operators', 'operators.id', '=', 'operation_areas.operator_id')
//            ->when($operationAreaId, function ($query) use ($operationAreaId) {
//                return $query->where('operation_areas.id', $operationAreaId);
//            })->when($operatorId, function ($query) use ($operatorId) {
//                return $query->where('operators.id', $operatorId);
//            })->select(\DB::raw('SUM(billings.last_index-starting_index), water_networks.id,water_networks.name,operation_areas.name as operation_area_name'))
//            ->groupByRaw('water_networks.id,water_networks.name,operation_area_name')
//            ->limit(5)
            ->get();
        $data = collect();
        foreach ($waterNetworks as $billing) {
            $data->push([
                'name' => $billing->name,
                'consumed_water' => floatval($billing->sum ?? 0),
                'url_logo' => asset('img/logo.svg'),
                'address' => $billing->operation_area_name ?? '',
            ]);
        }

        return $data;

    }

    public function getBillingPerMonth()
    {
        $operatorId = auth()->user()->operator_id;
        $operationAreaId = auth()->user()->operation_area;
        $billings = Billing::query()
            ->join('meter_requests', 'meter_requests.meter_number', '=', 'billings.meter_number')
            ->join('requests', 'requests.id', '=', 'meter_requests.request_id')
            ->when($operationAreaId, function ($query) use ($operationAreaId) {
                return $query->where('requests.operation_area_id', $operationAreaId);
            })->when($operatorId, function ($query) use ($operatorId) {
                return $query->where('requests.operator_id', $operatorId);
            })
            ->whereYear('billings.created_at', date('Y'))
            ->select(\DB::raw('SUM(billings.amount) as amount, extract("MONTH" FROM billings.created_at) as month'))
            ->groupByRaw('extract("MONTH" FROM billings.created_at)')
            ->get();
        $data = [];
        //get recent five months
        for ($i = 1; $i <= 12; $i++) {
            $monthShortName = date('M', mktime(0, 0, 0, $i, 10));
            $amount = $billings->where('month', $i)->first();
            $data[$monthShortName] = floatval($amount->amount ?? 0) ?? 0;
        }

        return $data;
    }
}
