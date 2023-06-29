<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\Customer;
use App\Models\MeterRequest;
use App\Models\Operator;
use App\Models\PaymentType;
use App\Models\Request;
use App\Models\WaterNetwork;

class HomeController extends Controller
{
    public function setLanguage($locale)
    {
        if (in_array($locale, ['en', 'rw'])) {
            session()->put('locale', $locale);
            app()->setLocale($locale);
        }
        return redirect()->back();
    }

    public function welcome()
    {
        $operators = Operator::query()->inRandomOrder()->get();
        $totalCustomers = Customer::query()
            ->whereHas('requests', function ($query) {
                $query->whereNotIn('status', Status::pendingStatuses());
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

    public function getOperatorsByDistrict()
    {
        $districtId = \request('district_id');

        $operators = Operator::query()
            ->whereHas('operationAreas', function ($query) use ($districtId) {
                $query->where('district_id', '=', $districtId);
            })
            ->get();
        return response()->json($operators);
    }

    public function viewMaterials(Request $request)
    {
        $request->load('items.item');
        $payDec = $request->paymentDeclarations()
            ->whereHas('paymentConfig.paymentType', function ($query) {
                $query->where('id', '=', PaymentType::MATERIALS_FEE);
            })->first();
        return view('client.view_materials', [
            'request' => $request,
            'payDec' => $payDec
        ]);
    }


}
