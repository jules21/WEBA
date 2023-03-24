<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillChargeRequest;
use App\Http\Requests\UpdateBillChargeRequest;
use App\Models\BillCharge;
use App\Models\OperationArea;

class BillChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $bills = BillCharge::with('waterNetworkType', 'operationArea')->orderBy('id', 'DESC')->get();
        return view('admin.settings.bill_charges', compact('bills'));
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
     * @param \App\Http\Requests\StoreBillChargeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBillChargeRequest $request)
    {
        $bill = new BillCharge();
        $bill->water_network_type_id = $request->water_network_type_id;
        $bill->operation_area_id = $request->operation_area_id;
        $bill->unit_price = $request->unit_price;
        $bill->save();
        return redirect()->back()->with('success', 'Bill Charge Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BillCharge $billCharge
     * @return \Illuminate\Http\Response
     */
    public function show(BillCharge $billCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BillCharge $billCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(BillCharge $billCharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateBillChargeRequest $request
     * @param \App\Models\BillCharge $billCharge
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBillChargeRequest $request, BillCharge $billCharge)
    {
        $bill = BillCharge::findOrFail($request->input('BillId'));
        $bill->water_network_type_id = $request->water_network_type_id;
        $bill->operation_area_id = $request->operation_area_id;
        $bill->unit_price = $request->unit_price;
        $bill->save();
        return redirect()->back()->with('success', 'Bill Charge Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BillCharge $billCharge
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
}
