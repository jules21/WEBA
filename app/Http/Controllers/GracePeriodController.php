<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\GracePeriod;
use App\Http\Requests\StoreGracePeriodRequest;
use App\Http\Requests\UpdateGracePeriodRequest;
use App\Models\OperationArea;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Utilities\Request;

class GracePeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request,$operation_area_id)
    {

        $gracePeriods = GracePeriod::query()
            ->where('operation_area_id',$operation_area_id)
            ->orderBy('id','desc')->select('grace_periods.*');
        $operationArea = OperationArea::find($operation_area_id);
        if ($request->ajax()){
            return $this->formatDataTable($gracePeriods);
        }
        return view('admin.area-of-operation.grace_periods.index',compact('operationArea'));
    }

    protected function formatDataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('Y-m-d H:i');
            })


            ->editColumn('days', function ($item) {
                return $item->days;
            })

            ->editColumn('status', function ($item) {
                if ($item->status == 'active') {
                    return '
                    <span class="badge badge-success">Active</span>';
                } else {
                    return '
                 <span class="badge badge-danger">Inactive</span>
                    ';

                }
            })


            ->addColumn('action', function ($item) {
                return view('admin.operator.contract.contract_action', compact('item'));
            })

            ->rawColumns(['created_at','days','status','action'])
            ->make(true);
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
     * @param  \App\Http\Requests\StoreGracePeriodRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGracePeriodRequest $request,$operation_area_id)
    {

        $operationArea = OperationArea::find($operation_area_id);

        $contract = new GracePeriod();
        $contract->operation_area_id=$operationArea->id;
        $contract->days=$request->days;
        $contract->status=$request->status;
        $contract->contract_id=$request->contract_id;
        $contract->save();
        return redirect()->back()->with('success','Grace Period Store Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GracePeriod  $gracePeriod
     * @return \Illuminate\Http\Response
     */
    public function show(GracePeriod $gracePeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GracePeriod  $gracePeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(GracePeriod $gracePeriod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGracePeriodRequest  $request
     * @param  \App\Models\GracePeriod  $gracePeriod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGracePeriodRequest $request, GracePeriod $gracePeriod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GracePeriod  $gracePeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy(GracePeriod $gracePeriod)
    {
        //
    }
}
