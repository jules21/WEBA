<?php

namespace App\Http\Controllers;

use App\Constants\BalanceType;
use App\Http\Requests\ValidateLedgerMigration;
use App\Models\ChartAccount;
use App\Models\LedgerMigration;
use Exception;

class LedgerMigrationController extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        $ledgerMigrations = LedgerMigration::query()
            ->with('ledgerGroup', 'ledgerCategory', 'ledger')
            ->where('operation_area_id', '=', auth()->user()->operation_area)
            ->latest()
            ->get();

        $totalCredits = $ledgerMigrations->where('balance_type', BalanceType::CREDIT)->sum('amount');
        $totalDebits = $ledgerMigrations->where('balance_type', BalanceType::DEBIT)->sum('amount');
        $totalBalance = $totalDebits - $totalCredits;

        $ledgerGroups = ChartAccount::query()->where('level', '=', 1)->get();
        return view('admin.accounting.ledger-migration.index',[
            'ledgerMigrations' => $ledgerMigrations,
            'ledgerGroups' => $ledgerGroups,
            'totalCredits' => $totalCredits,
            'totalDebits' => $totalDebits,
            'totalBalance' => $totalBalance,
        ]);
    }

    public function store(ValidateLedgerMigration $request)
    {
        $data = $request->validated();
        $id = $request->input('id');

        $data['user_id'] = auth()->id();
        $data['operation_area_id'] = auth()->user()->operation_area;

        if ($id > 0) {
            $model = LedgerMigration::query()->find($id);
            $model->update($model);
        } else {
            $model = LedgerMigration::query()->create($data);
        }

        if ($request->ajax()) {
            session()->flash('success', 'Ledger Migration saved successfully.');
            return response()->json([
                'message' => 'Ledger Migration saved successfully.',
                'data' => $model
            ]);
        }
        return back()
            ->with('success', 'Ledger Migration saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param LedgerMigration $ledgerMigration
     * @return LedgerMigration
     */
    public function show(LedgerMigration $ledgerMigration)
    {
        return $ledgerMigration;
    }


    public function destroy(LedgerMigration $ledgerMigration)
    {
        $ledgerMigration->delete();
        return response()->json([
            'message' => 'Ledger Migration deleted successfully.'
        ]);
    }
}
