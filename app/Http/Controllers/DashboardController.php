<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MeterRequest;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalOperators = Operator::count();
        $totalOperationAreas = OperationArea::count();
        $totalStocks = Stock::count();
        $totalMeters = MeterRequest::count();
        $totalCustomers = Customer::count();
        return view('admin.dashboard', compact('totalOperators', 'totalOperationAreas', 'totalStocks', 'totalMeters', 'totalCustomers'));
    }
}
