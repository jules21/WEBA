<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChartAccountRequest;
use App\Http\Requests\UpdateChartAccountRequest;
use App\Models\ChartAccount;

class ChartAccountController extends Controller
{
    public function index()
    {
        $chartAccounts = ChartAccount::query()
            ->where('operation_area_id', '=', auth()->user()->operation_area)
            ->whereNull('parent_ledger_no')
            ->with('children.children')
//            ->orderBy('code')
            ->get();
        return view('admin.accounting.chart_of_accounts', compact('chartAccounts'));
    }

}
