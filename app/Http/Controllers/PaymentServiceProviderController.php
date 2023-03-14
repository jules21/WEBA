<?php

namespace App\Http\Controllers;

use App\Models\PaymentServiceProvider;
use Illuminate\Http\Request;

class PaymentServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->can("Manage banks")) {
            $banks = PaymentServiceProvider::query()->get();
            return view('admin.settings.payment_service_provider', compact('banks'));
        }
        abort(403, 'Unauthorized action.');
    }

    public function syncBanks()
    {
        try {
            $response = \Http::withHeaders([
                'Accept' => 'application/json',
                'CMS-RWSS-Key' => config('app.CMS-RWSS-Key'),
            ])->get(config('app.CLMS_URL') . '/api/v1/cms-rwss/get-payment-service-providers');
            if ($response->failed()) {
                return redirect()->back()->with('error', 'Something went wrong');
            }
            $banks = json_decode($response->body());
            foreach ($banks as $bank) {
                PaymentServiceProvider::query()->updateOrCreate(['id' => $bank->id], (array)$bank);
            }
            return redirect()->back()->with('success', 'Banks synced successfully');
        } catch (\Exception $exception) {
            info($exception->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
