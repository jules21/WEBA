<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //

    public function recentRecords()
    {
        $user = auth()->user();
        $billing = Billing::query()
            ->with('meterRequest.request.customer')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'action' => 1,
            'message' => 'Billing Records',
            'data' => $billing
        ]);
    }
}
