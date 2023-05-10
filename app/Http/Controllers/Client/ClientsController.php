<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Operator;
use App\Models\Request;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Builder;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function home()
    {
        $operators = Operator::query()
            ->latest()
            ->get();
        $recentRequests = Request::with(['requestType', 'operator'])
            ->whereHas('customer', function (Builder $builder) {
                $builder->where('doc_number', '=', auth('client')->user()->doc_number);
            })
            ->latest()
            ->limit(5)
            ->get();
        return view('client.home', [
            'operators' => $operators,
            'recentRequests' => $recentRequests
        ]);
    }

    public function newConnection(Operator $operator)
    {

        $operationAreas = $operator->operationAreas()
            ->pluck('district_id')
            ->toArray();

        $sectors = Sector::query()
            ->whereIn('district_id', $operationAreas)
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

    public function profile()
    {
        return view('client.profile');
    }

    public function updateProfile(Request $request, Client $client)
    {
        dd($request->all()->toArray());
    }
}
