<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfNotClient;
use App\Models\Client;
use App\Models\District;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Request;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Sector_C;
use LaravelIdea\Helper\App\Models\_IH_Sector_QB;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfNotClient::class);
    }

    public function home()
    {
        $districts = District::query()
            ->whereHas('operationAreas')
            ->orderBy('name')
            ->get();
        $recentRequests = Request::with(['requestType', 'operator'])
            ->whereHas('customer', function (Builder $builder) {
                $builder->where('doc_number', '=', auth('client')->user()->doc_number);
            })
            ->latest()
            ->limit(5)
            ->get();
        return view('client.home', [
            'districts' => $districts,
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

    public function help()
    {
        return view('client.help');
    }

    public function faq()
    {
        return view('client.faq');
    }

}
