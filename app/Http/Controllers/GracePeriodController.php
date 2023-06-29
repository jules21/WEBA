<?php

namespace App\Http\Controllers;

use App\Mail\GracePeriodUpdate;
use App\Models\Contract;
use App\Models\GracePeriod;
use App\Http\Requests\StoreGracePeriodRequest;
use App\Http\Requests\UpdateGracePeriodRequest;
use App\Models\OperationArea;
use Carbon\Carbon;
use PHPUnit\Exception;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Utilities\Request;

class GracePeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $gracePeriods = GracePeriod::query()
            ->when($request->operation_area_id, function ($builder) use ($request){
                    $builder->where('operation_area_id',decryptId($request->operation_area_id));
            })
            ->when($request->contract_id, function ($builder) use ($request){
                $builder->where('contract_id',decryptId($request->contract_id));
            })

            ->orderBy('id','desc')->select('grace_periods.*');
        if ($request->ajax()){
            return $this->formatDataTable($gracePeriods);
        }
        return view('admin.area-of-operation.grace_periods.index');
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
                return view('admin.area-of-operation.grace_periods.grace_period_action', compact('item'));
            })

            ->rawColumns(['created_at','days','status'])
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
    public function store(StoreGracePeriodRequest $request)
    {
        $grace_period = new GracePeriod();
        $grace_period->operation_area_id=$request->input('operation_area_id') !=null ? decryptId($request->operation_area_id): null;
        $grace_period->contract_id=$request->input('contract_id') !=null ? decryptId($request->contract_id): null;
        $grace_period->days=$request->days;
        $grace_period->status='active';

        //if its on operation area
        if ($request->input('operation_area_id') !=null){
            $operationArea= OperationArea::find(decryptId($request->input('operation_area_id')));
            $fromDate = $operationArea->valid_to;
            $validTo = Carbon::parse($fromDate)->addDay($request->input('days'));
            $contactPersonName = $operationArea->contact_person_name;
            $contactPersonEmail = $operationArea->contact_person_email;
            $type = optional($operationArea->district)->name;
            GracePeriod::query()->whereNull('contract_id')->update(['status' => 'inactive']);
        }
        //if its on contract
        if ($request->input('contract_id') !=null){
            $contract= Contract::find(decryptId($request->input('contract_id')));
            $fromDate = $contract->start_date;
            $validTo = $contract->expire_date ==null
                ? Carbon::parse($fromDate)->addDay($request->input('days'))
                : Carbon::parse($contract->expire_date)->addDay($request->input('days'));
            $contactPersonName = optional($contract->operationArea)->contact_person_name;
            $contactPersonEmail = optional($contract->operationArea)->contact_person_email;
            $contract->update(['expire_date' =>$validTo]);
            $type = "Contract";
            GracePeriod::query()->whereNull('operation_area_id')->update(['status' => 'inactive']);
          // dd($request->all(), $contract, $grace_period);
        }
        $grace_period->save();

         // return new GracePeriodUpdate($request->input('days'), $fromDate,$validTo,$contactPersonEmail,$contactPersonName);

        // Queue the email sending
        \Mail::to($contactPersonEmail)->queue(new GracePeriodUpdate($request->input('days'), $fromDate,$validTo,$contactPersonEmail,$contactPersonName, $type));


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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GracePeriod $gracePeriod,$id)
    {
        try {
            $gracePeriod = GracePeriod::find($id);
            $gracePeriod->delete();
            return redirect()->back()->with('success','Grace Period deleted successfully');
        }catch (Exception $exception){
            info($exception);
            return redirect()->back()->with('error','Grace Period can not be deleted');
        }
    }
}
