<?php

namespace App\Http\Controllers;

use App\Exports\BillChargeExport;
use App\Http\Requests\StoreBillChargeRequest;
use App\Http\Requests\UpdateBillChargeRequest;
use App\Models\BillCharge;
use App\Models\OperationArea;
use App\Models\Operator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class BillChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $user = auth()->user();

        if ($user->is_super_admin) {
            $startDate = request('start_date');
            $endDate = request('end_date');
            $operation_area_id = request('operation_area_id');
            $water_network_type_id = request('water_network_type_id');
            $operator_id = request('operator_id');

            $operators = Operator::all();
            $operationAreas = OperationArea::query()->findMany($operation_area_id);
            $bills = BillCharge::with('waterNetworkType', 'operationArea', 'operator')
                ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                    $builder->whereDate('created_at', '>=', $startDate);
                })
                ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                    $builder->whereDate('created_at', '<=', $endDate);
                })
                ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                    $builder->whereIn('operation_area_id', $operation_area_id);
                })
                ->when(!empty($water_network_type_id), function (Builder $builder) use ($water_network_type_id) {
                    $builder->where('water_network_type_id', $water_network_type_id);
                })
                ->when(!empty($operator_id), function (Builder $builder) use ($operator_id) {
                    $builder->where('operator_id', $operator_id);
                })
                ->orderBy('id', 'DESC')
                ->get();

            $Areas = OperationArea::query()
                ->when(isOperator(), function (Builder $builder) {
                    $builder->where('operator_id', '=', auth()->user()->operator_id);
                })
                ->when(isForOperationArea(), function (Builder $builder) {
                    $builder->where('id', '=', auth()->user()->operation_area);
                })
                ->get();

            return view('admin.settings.bill_charges', compact('bills', 'operators', 'operationAreas','Areas'));
        } else {
            $startDate = request('start_date');
            $endDate = request('end_date');
            $operation_area_id = request('operation_area_id');
            $water_network_type_id = request('water_network_type_id');
            $operator_id = request('operator_id');

            $operators = Operator::all();
            $operationAreas = OperationArea::query()->findMany($operation_area_id);
            $bills = BillCharge::query()->where('operator_id', '=', auth()->user()->operator_id)->with('waterNetworkType', 'operationArea', 'operator')
                ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                    $builder->whereDate('created_at', '>=', $startDate);
                })
                ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                    $builder->whereDate('created_at', '<=', $endDate);
                })
                ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                    $builder->whereIn('operation_area_id', $operation_area_id);
                })
                ->when(!empty($water_network_type_id), function (Builder $builder) use ($water_network_type_id) {
                    $builder->where('water_network_type_id', $water_network_type_id);
                })
                ->when(!empty($operator_id), function (Builder $builder) use ($operator_id) {
                    $builder->where('operator_id', $operator_id);
                })
                ->orderBy('id', 'DESC')
                ->get();

            $Areas = OperationArea::query()
                ->when(isOperator(), function (Builder $builder) {
                    $builder->where('operator_id', '=', auth()->user()->operator_id);
                })
                ->when(isForOperationArea(), function (Builder $builder) {
                    $builder->where('id', '=', auth()->user()->operation_area);
                })
                ->get();

            return view('admin.settings.bill_charges', compact('bills', 'operators', 'operationAreas','Areas'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBillChargeRequest $request)
    {
        $bill = new BillCharge();
        $bill->water_network_type_id = $request->water_network_type_id;
        $bill->operation_area_id = $request->operation_area_id;
        $bill->unit_price = $request->unit_price;
        $bill->operator_id = $request->operator_id;
        $bill->save();

        return redirect()->back()->with('success', 'Bill Charge Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BillCharge $billCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BillCharge $billCharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBillChargeRequest $request, BillCharge $billCharge)
    {
        $bill = BillCharge::findOrFail($request->input('BillId'));
        $bill->water_network_type_id = $request->water_network_type_id;
        $bill->operation_area_id = $request->operation_area_id;
        $bill->unit_price = $request->unit_price;
        $bill->operator_id = $request->operator_id;
        $bill->save();

        return redirect()->back()->with('success', 'Bill Charge Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BillCharge $billCharge, $id)
    {
        try {
            $bill = BillCharge::find($id);
            $bill->delete();

            return redirect()->back()->with('success', 'Bill Charge deleted Successfully');
        } catch (\Exception $exception) {
            info($exception);

            return redirect()->back()->with('error', 'Bill Charge Can not be deleted');
        }
    }

    public function loadAreaOperationAreas()
    {
        $water_network_type_id = request('water_network_type_id');

        $operation_areas = OperationArea::query()
            ->where([
                ['operator_id', '=', auth()->user()->operator_id],
            ])
            ->whereDoesntHave('billCharges', function ($query) use ($water_network_type_id) {
                $query->where([
                    ['water_network_type_id', '=', $water_network_type_id],
                    //                    ['operation_area_id', '=', auth()->user()->operation_area]
                ]);
            })
            ->get();

        return response()->json($operation_areas);
    }

    public function loadAreaOperation($id)
    {
        $areas = OperationArea::where('operator_id', $id)->get();

        return response()->json($areas);
    }

    public function export()
    {
        return Excel::download(new BillChargeExport(), 'bill-charges.xlsx');
    }
}
