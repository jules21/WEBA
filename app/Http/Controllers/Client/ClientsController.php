<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeClientPasswordRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Middleware\RedirectIfNotClient;
use App\Models\Client;
use App\Models\District;
use App\Models\Faq;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Request;
use App\Models\Sector;
use App\Models\UserManual;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
