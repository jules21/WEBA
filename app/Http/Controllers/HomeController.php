<?php

namespace App\Http\Controllers;

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
                $query->whereNotIn('status', [Request::REJECTED, Request::ASSIGNED, Request::PENDING]);
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
}
