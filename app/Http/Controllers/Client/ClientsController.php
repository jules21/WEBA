<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\Request;
use App\Models\Sector;
use App\Models\WaterUsage;

class ClientsController extends Controller
{
    public function home()
    {
        $recentOperators = Operator::query()
            ->latest()
            ->limit(2)
            ->get();
        $operators = Operator::query()
            ->latest()
            ->get();
        $recentRequests = Request::with(['requestType', 'operator'])
            ->latest()
            ->limit(5)
            ->get();
        return view('client.home', [
            'recentOperators' => $recentOperators,
            'operators' => $operators,
            'recentRequests' => $recentRequests
        ]);
    }

    public function newConnection(Operator $operator)
    {

        $sectors = Sector::query()
            ->where('district_id', '=', $operator->district_id)
            ->get();
        $requestTypes = $this->getRequestsTypes();
        $waterUsage = $this->getWaterUsages();
        $roadTypes = $this->getRoadTypes();
        $roadCrossTypes = $this->getRoadCrossTypes();

        return view('client.new_connections', [
            'operator' => $operator,
            'sectors' => $sectors,
            'requestTypes' => $requestTypes,
            'waterUsage' => $waterUsage,
            'roadTypes' => $roadTypes,
            'roadCrossTypes' => $roadCrossTypes
        ]);
    }
}
