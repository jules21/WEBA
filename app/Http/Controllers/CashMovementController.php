<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateChashMovementRequest;
use App\Models\CashMovement;
use App\Models\PaymentServiceProvider;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CashMovementController extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = CashMovement::query()
                ->with(['paymentServiceProvider'])
                ->select('cash_movements.*');
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                          <button class="btn btn-light-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                            Options
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item js-edit" href="' . route('admin.accounting.cash-movement.show', encryptId($row->id)) . '"> <i class="fa fa-edit mr-2"></i> Edit</a>
                            <a class="dropdown-item js-delete" href="' . route('admin.accounting.cash-movement.delete', encryptId($row->id)) . '"> <i class="fa fa-trash text-danger mr-2"></i> Delete</a>
                          </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        $banks = PaymentServiceProvider::query()
            ->get();
        return view('admin.accounting.cash-movements', [
            'banks' => $banks
        ]);
    }

    public function store(ValidateChashMovementRequest $request)
    {
        $data = $request->validated();

        $data['operation_area_id'] = auth()->user()->operation_area;
        $data['user_id'] = auth()->user()->id;
        $id = $request->input('id');
        if ($id) {
            $model = CashMovement::query()->where('id', $id)
                ->update($data);
        } else {
            $model = CashMovement::query()->create($data);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cash Movement saved successfully',
                'data' => $model
            ]);
        }

        return redirect()->back()
            ->with('success', 'Cash Movement saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param CashMovement $cashMovement
     * @return CashMovement
     */
    public function show(CashMovement $cashMovement)
    {
        return $cashMovement;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param CashMovement $cashMovement
     * @return JsonResponse
     */
    public function destroy(CashMovement $cashMovement)
    {
        $cashMovement->delete();
        return response()->json([
            'success' => true,
            'message' => 'Cash Movement deleted successfully',
        ]);
    }
}
