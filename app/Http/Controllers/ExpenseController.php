<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateExpenseRequest;
use App\Models\ChartAccount;
use App\Models\Expense;
use Exception;
use function request;

class ExpenseController extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Expense::query()
                ->with(['expenseLedger', 'paymentLedger'])
                ->where('operation_area_id', auth()->user()->operation_area)
                ->select('expenses.*');
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                          <button class="btn btn-light-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                            Options
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item js-edit" href="' . route('admin.accounting.expenses.show', encryptId($row->id)) . '"> <i class="fa fa-edit mr-2"></i> Edit</a>
                            <a class="dropdown-item js-delete" href="' . route('admin.accounting.expenses.delete', encryptId($row->id)) . '"> <i class="fa fa-trash text-danger mr-2"></i> Delete</a>
                          </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        $expenseCategories = ChartAccount::query()
            ->where([
                ['operation_area_id', '=', auth()->user()->operation_area],
                ['level', '=', 2],
            ])
            ->whereRaw('ledger_no/400 < 100')
            ->get();
        $paymentLedgers = ChartAccount::query()
            ->where([
                ['operation_area_id', '=', auth()->user()->operation_area],
                ['level', '=', 3],
                ['ledger_no', '<', 10300]
            ])
            ->get();

        return view('admin.accounting.expenses', [
            'expenseCategories' => $expenseCategories,
            'paymentLedgers' => $paymentLedgers
        ]);
    }

    public function store(ValidateExpenseRequest $request)
    {
        $data = $request->validated();
        $id = $request->input('id');
        $data['operation_area_id'] = auth()->user()->operation_area;
        $data['user_id'] = auth()->id();
        if ($id > 0) {
            $expense = Expense::query()->findOrFail($id);
            $expense->update($data);
        } else {
            $expense = Expense::query()->create($data);
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Expense saved successfully',
                'data' => $expense
            ]);
        }

        return redirect()->route('admin.accounting.expenses')
            ->with('success', 'Expense saved successfully');
    }


    public function show(Expense $expense)
    {
        return $expense;
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Expense deleted successfully',
        ]);
    }

    public function getExpenseLedgers($id)
    {
        $account = ChartAccount::query()
            ->findOrFail($id);
        return $account->children()->get();

    }
}
