<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Customer;
use App\Models\MeterRequest;
use App\Models\Operator;
use App\Models\Request;
use App\Models\WaterNetwork;

class HomeController extends Controller
{
    public function welcome()
    {
        $operators = Operator::query()->inRandomOrder()->get();
        $totalCustomers = Customer::query()
            ->whereHas('requests', function ($query) {
                $query->whereNotIn('status', [Status::REJECTED, Status::ASSIGNED, Status::PENDING]);
            })->count();
        $totalWaterConnections = MeterRequest::query()->count();
        $totalWaterNetworks = WaterNetwork::query()->count();

        return view('welcome', [
            'operators' => $operators,
            'totalCustomers' => $totalCustomers,
            'totalWaterConnections' => $totalWaterConnections,
            'totalWaterNetworks' => $totalWaterNetworks,
        ]);
    }

    public function home()
    {
        $operators = Operator::query()
            ->latest()
            ->get();
        $recentRequests = Request::with(['requestType','operator'])
            ->latest()
            ->limit(5)
            ->get();
        return view('clients.home', [
            'operators' => $operators,
            'recentRequests' => $recentRequests
        ]);
    }
}
