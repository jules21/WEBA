<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateServiceProviderAccountRequest;
use App\Models\ChartAccount;
use App\Models\Currency;
use App\Models\PaymentServiceProvider;
use App\Models\PaymentServiceProviderAccount;
use DB;
use Exception;
use Throwable;

class PaymentServiceProviderAccountController extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = PaymentServiceProviderAccount::query()
                ->with(['paymentServiceProvider'])
                ->select('payment_service_provider_accounts.*');
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    if (auth()->user()->operation_area) {
                        return '<div class="dropdown">
                          <button class="btn btn-light-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                            Options
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item js-edit" href="' . route('admin.accounting.bank-accounts.show', encryptId($row->id)) . '"> <i class="fa fa-edit mr-2"></i> Edit</a>
                            <a class="dropdown-item js-delete" href="' . route('admin.accounting.bank-accounts.delete', encryptId($row->id)) . '"> <i class="fa fa-trash text-danger mr-2"></i> Delete</a>
                          </div>
                        </div>';
                    }
                    return "";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $serviceProviders = PaymentServiceProvider::all();
        $currencies = Currency::query()
            ->get();
        return view('admin.accounting.bank_accounts', [
            'serviceProviders' => $serviceProviders,
            'currencies' => $currencies
        ]);
    }


    /**
     * @throws Throwable
     */
    public function store(ValidateServiceProviderAccountRequest $request)
    {
        $data = $request->validated();
        $id = $request->input('id');
        DB::beginTransaction();
        $data['operation_area_id'] = auth()->user()->operation_area;
        if ($id == 0) {
            $bankLedgerGroupNo = 102;
            $gl = ChartAccount::query()
                ->where('operation_area_id', auth()->user()->operation_area)
                ->where('parent_ledger_no', '=', $bankLedgerGroupNo)
                ->orderByDesc('ledger_no')
                ->first();
            if (is_null($gl)) {
                $ledgerNo = $bankLedgerGroupNo . '01';
            } else {
                $ledgerNo = $gl->ledger_no + 1;
            }
            $data['ledger_no'] = $ledgerNo;
            ChartAccount::query()
                ->create([
                    'operation_area_id' => auth()->user()->operation_area,
                    'ledger_no' => $ledgerNo,
                    'level' => 3,
                    'parent_ledger_no' => $bankLedgerGroupNo,
                    'ledger_type' => 'D',
                    'is_active' => true,
                    'ledger_description' => $data['account_name'] . "-Account No: " . $data['account_number'],
                ]);
        }
        $data['currency'] = "RWF";
        if ($id == 0) {
            $paymentServiceProviderAccount = PaymentServiceProviderAccount::query()
                ->create($data);
        } else {
            $paymentServiceProviderAccount = PaymentServiceProviderAccount::query()
                ->findOrFail($id);
            $paymentServiceProviderAccount->update($data);
        }
        DB::commit();
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment Service Provider Account saved successfully.',
                'data' => $paymentServiceProviderAccount
            ]);
        }
        return redirect()->route('payment_service_provider_accounts.index')
            ->with('success', 'Payment Service Provider Account saved successfully.');
    }

    public function show(PaymentServiceProviderAccount $paymentServiceProviderAccount)
    {
        return response()->json($paymentServiceProviderAccount);
    }


    /**
     * @throws Throwable
     */
    public function destroy($id)
    {
        $paymentServiceProviderAccount = PaymentServiceProviderAccount::query()
            ->findOrFail(decryptId($id));
        DB::beginTransaction();
        ChartAccount::query()
            ->where('ledger_no', '=', $paymentServiceProviderAccount->ledger_no)
            ->where('operation_area_id', '=', auth()->user()->operation_area)
            ->delete();
        $paymentServiceProviderAccount->delete();
        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Payment Service Provider Account deleted successfully.',
        ]);
    }

    public function accountsByServiceProvider($id)
    {
        $paymentServiceProvider = PaymentServiceProvider::query()
            ->findOrFail($id);
        $accounts = $paymentServiceProvider->accounts()->get();
        return response()->json($accounts);
    }
}
