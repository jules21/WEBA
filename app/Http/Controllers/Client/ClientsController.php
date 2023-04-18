<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\Request;

class ClientsController extends Controller
{
    public function home()
    {
        $recentOperators = Operator::query()
            ->latest()
            ->limit(5)
            ->get();
        $operators = Operator::query()
            ->latest()
            ->get();
        $recentRequests = Request::with(['requestType','operator'])
            ->latest()
            ->limit(5)
            ->get();
        return view('client.home', [
            'recentOperators' => $recentOperators,
            'operators' => $operators,
            'recentRequests' => $recentRequests
        ]);
    }
    public function newConnection()
    {
        return view('client.new_connections');
    }
}
