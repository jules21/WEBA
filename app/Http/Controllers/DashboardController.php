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
        if (auth()->user()->operator_id == null && auth()->user()->operation_area == null) {
            return $this->level1Dashboard();
        } elseif (auth()->user()->operator_id != null && auth()->user()->operation_area == null) {
            return $this->level2Dashboard();
        } elseif (auth()->user()->operation_area != null) {
            return $this->level3Dashboard();
        }
        return back()->with('error', 'You are not authorized to access this page');
    }

    /**
     * level1Dashboard is for user with no operator and no operation area
     */
    public function level1Dashboard()
    {
        $totalOperators = Operator::query()
            ->when(auth()->user()->district_id, function (Builder $query) {
                $query->whereHas('operationAreas', function (Builder $query) {
                    $query->where('district_id', auth()->user()->district_id);
                });
            })->count();
        $totalOperationAreas = OperationArea::query()
            ->when(auth()->user()->district_id, function (Builder $query) {
                $query->where('district_id', auth()->user()->district_id);
            })->count('district_id');
        $totalMeters = MeterRequest::when(auth()->user()->district_id, function (Builder $query) {
            $query->whereHas('request', function (Builder $query) {
                $query->where('district_id', auth()->user()->district_id);
            });
        })->count();

        $totalCustomers = Customer::query()->wherehas('connections', function ($query) {
            $query->when(auth()->user()->district_id, function (Builder $query) {
                $query->whereHas('request', function (Builder $query) {
                    $query->where('district_id', auth()->user()->district_id);
                });
            });
        })->count('doc_number');
        $consumptionPerMonth = $this->getConsumedWater();
        $topOperators = $this->getTopOperators();
        $consumerPerOperators = $this->getOperatorConsumers();
        $recentPayment = $this->getRecentFiveMothPayment();
        return view('admin.dashboard.level1', compact('totalOperators', 'totalOperationAreas',
            'totalMeters', 'totalCustomers', 'consumptionPerMonth',
            'topOperators', 'consumerPerOperators', 'recentPayment'));
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
        $waterNetworks = WaterNetwork::query()
            ->where('operator_id', auth()->user()->operator_id)->count();
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
        $recentPayment = $this->getBillsPayment();
        $billingsPerMonth = $this->getBillingPerMonth();

        return view('admin.dashboard.level2',
            compact('waterNetworks', 'totalOperationAreas',
                'totalMeters', 'totalCustomers', 'consumptionPerMonth',
                'topOperators', 'consumerPerOperators', 'recentPayment',
                'rejectRequests', 'approveRequests', 'pendingRequests', 'allRequests',
                'billingsPerMonth'));
    }

    /**
     * level3Dashboard is for user with operator and operation area
     */
    public function level3Dashboard()
    {
        $inStockMeters = Stock::query()
            ->where('operation_area_id', auth()->user()->operation_area)
            ->whereHas('item', function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('is_meter', true);
                });
            })->sum('quantity');
        $totalMeters = MeterRequest::query()
            ->whereHas('request', function ($query) {
                $query->where('operator_id', auth()->user()->operator_id);
            })->count();
        $totalCustomers = Customer::wherehas('requests', function ($query) {
            $query->where('operation_area_id', auth()->user()->operation_area)
                ->whereHas('meterNumbers');
        })->count('doc_number');

        $waterNetworks = WaterNetwork::query()
            ->where('district_id', auth()->user()->district_id)->count();
        $requests = Request::query()
            ->where('operation_area_id', auth()->user()->operation_area)->get(['id', 'status']);

        $allRequests = $requests->count();
        $rejectRequests = $requests->whereIn('status', [Status::REJECTED,
            Status::CANCELLED])->count();
        $approveRequests = $requests->whereIn('status', [
            Status::APPROVED,
            Status::DELIVERED,
            Status::PARTIALLY_DELIVERED,
            Status::METER_ASSIGNED,])->count();
        $pendingRequests = $requests->whereIn('status', [Status::PENDING])->count();

        $consumptionPerMonth = $this->getConsumedWater();
        $topOperators = $this->getTopWaterNetWorks();
        $consumerPerOperators = $this->getOperatorConsumers();
        $recentPayment = $this->getBillsPayment();
        $billingsPerMonth = $this->getBillingPerMonth();

        return view('admin.dashboard.level3',
            compact('waterNetworks', 'inStockMeters',
                'totalMeters', 'totalCustomers', 'consumptionPerMonth',
                'topOperators', 'consumerPerOperators', 'recentPayment',
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

    private function getTopOperators()
    {
        $operators = Operator::query()
            ->join('requests', 'requests.operator_id', '=', 'operators.id')
            ->join('meter_requests', 'meter_requests.request_id', '=', 'requests.id')
            ->join('billings', 'billings.subscription_number', '=', 'meter_requests.subscription_number')
            ->when(auth()->user()->district_id, function ($query) {
                return $query->where('requests.district_id', auth()->user()->district_id);
            })->select(\DB::raw('SUM(billings.last_index-starting_index) as consumed_water, operators.id, operators.name,operators.logo,operators.address'))
            ->groupByRaw('operators.id,operators.name')
            ->orderBy('consumed_water', 'desc')
            ->limit(5)
            ->get();
        $data = collect();
        foreach ($operators as $operator) {
            $data->push([
                'name' => $operator->name,
                'consumed_water' => floatval($operator->consumed_water ?? 0),
                'url_logo' => $operator->logo_url,
                'address' => $operator->address ?? '',
            ]);
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

    public function getRecentFiveMothPayment()
    {
        $billings = Payment::query()
            ->when(auth()->user()->district_id, function ($query) {
                return $query->whereHas('billing.meterRequest.request', function ($query) {
                    return $query->where('district_id', auth()->user()->district_id);
                });
            })
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime('-5 months')))
            ->select(\DB::raw('sum(amount) as amount, extract("MONTH" FROM created_at) as month, extract("YEAR" FROM created_at) as year'))
            ->groupByRaw('extract("MONTH" FROM created_at),extract("YEAR" FROM created_at)')
            ->get();
        $data = [];
        //get recent five months
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $data[date("M-Y", strtotime($month))] = floatval($billings->where('month', date('m', strtotime($month)))->where('year', date('Y', strtotime($month)))->first()->amount ?? 0) ?? 0;
        }

        return $data;
    }

    private function getTopWaterNetWorks()
    {
        $operatorId = auth()->user()->operator_id;
        $operationAreaId = auth()->user()->operation_area;
        $waterNetworks = WaterNetwork::query()
            ->join('requests', 'requests.water_network_id', '=', 'water_networks.id')
            ->join('meter_requests', 'meter_requests.request_id', '=', 'requests.id')
            ->join('billings', 'billings.subscription_number', '=', 'meter_requests.subscription_number')
            ->join('operation_areas', 'operation_areas.id', '=', 'requests.operation_area_id')
            ->join('operators', 'operators.id', '=', 'operation_areas.operator_id')
            ->when($operationAreaId, function ($query) use ($operationAreaId) {
                return $query->where('operation_areas.id', $operationAreaId);
            })->when($operatorId, function ($query) use ($operatorId) {
                return $query->where('operators.id', $operatorId);
            })->select(\DB::raw('SUM(billings.last_index-starting_index), water_networks.id,water_networks.name,operation_areas.name as operation_area_name'))
            ->groupByRaw('water_networks.id,water_networks.name,operation_area_name')
            ->limit(5)
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

    public function getBillsPayment()
    {
        $payments = Payment::query()
            ->whereHas('billing', function (Builder $builder) {
                $builder->whereHas('meterRequest', function (Builder $builder) {
                    $builder->whereHas('request', function (Builder $builder) {
                        $builder->when(auth()->user()->operation_area, function ($query) {
                            return $query->where('operation_area_id', auth()->user()->operation_area);
                        })->when(auth()->user()->operator_id, function ($query) {
                            return $query->where('operator_id', auth()->user()->operator_id);
                        });
                    });
                });
            })->select(\DB::raw('sum(payments.amount) as amount, extract("MONTH" FROM payments.created_at) as month,payments.id'))
            ->groupByRaw('extract("MONTH" FROM payments.created_at),payments.id')
            ->get();
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthShortName = date('M', mktime(0, 0, 0, $i, 10));
            $amount = $payments->where('month', $i)->first();
            $data[$monthShortName] = floatval($amount->amount ?? 0) ?? 0;
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
