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
        if (auth()->user()->can("Manage banks")) {
            $banks = PaymentServiceProvider::query()->orderBy('created_at', 'desc')->get();
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
                $array = array();
                $array['name'] = $bank->name;
                $array['client_id'] = $bank->client_id;
                $array['client_secret'] = $bank->client_secret;
                $array['supports_payment'] = true;
                $array['is_active'] = true;
                PaymentServiceProvider::query()->updateOrCreate(['clms_id' => $bank->id], $array);
            }
            return redirect()->back()->with('success', 'Banks synced successfully');
        } catch (\Exception $exception) {
            info($exception->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function addBank(Request $request)
    {
        $bank = new PaymentServiceProvider();
        $bank->name = $request->name;
        $bank->is_active = true;
        $bank->save();
        return redirect()->back()->with('success', 'Bank added successfully');
    }

    public function deleteBank($bankId)
    {
        try {
            $bank = PaymentServiceProvider::find($bankId);
            $bank->delete();
            return redirect()->back()->with('success', 'Bank deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Bank cannot be deleted it has been used');
        }

    }

    public function updateBank(Request $request, $bankId)
    {
        $bank = PaymentServiceProvider::find($bankId);
        $bank->name = $request->name;
        $bank->is_active = $request->is_active;
        $bank->save();
        return redirect()->back()->with('success', 'Bank updated successfully');
    }

}
