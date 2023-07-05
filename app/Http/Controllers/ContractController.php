<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\OperationArea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Utilities\Request;
use Carbon\Carbon;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request,$operation_area_id)
    {

        $areas = OperationArea::query()
            ->when(isOperator(), function (Builder $builder) {
                $builder->where('operator_id', '=', auth()->user()->operator_id);
            })
            ->when(isForOperationArea(), function (Builder $builder) {
                $builder->where('id', '=', auth()->user()->operation_area);
            })
            ->get();

        $contracts = Contract::with('operationArea')
            ->orderBy('id','desc')
            ->where('operation_area_id',$operation_area_id)
            ->select('contracts.*');
        $operationArea = OperationArea::find(decryptId($operation_area_id));
        if ($request->ajax()){
            return $this->formatDataTable($contracts);
        }
        return view('admin.operator.contract.index',compact('areas','operationArea','contracts'));
    }

    protected function formatDataTable($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('Y-m-d H:i');
            })


            ->editColumn('name', function ($item) {
                return $item->name;
            })

            ->editColumn('operation_area_id', function ($item) {
                return optional($item->operationArea)->name;
            })

            ->editColumn('status', function ($item) {
                if ($item->status == '1') {
                    return '
                    <span class="badge badge-success">Active</span>';
                } else {
                    return '
                 <span class="badge badge-danger">Inactive</span>
                    ';

                }
            })

            ->addColumn('attachment', function ($item) {
                return '<a href="' . route('admin.operator.contracts.download', $item->id) . '">Download</a>';
            })


            ->addColumn('action', function ($item) {
                return view('admin.operator.contract.contract_action', compact('item'));
            })

            ->rawColumns(['created_at','name','status','operation_area_id','action'])
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
     * @param  \App\Http\Requests\StoreContractRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContractRequest $request,$operation_area_id)
    {

        $dir = 'public/contract/attachments';
        $path = $request->file('attachment')->store($dir);
        $attachment= str_replace($dir,'',$path);

        $operationArea = OperationArea::find($operation_area_id);
        $contract = new Contract();
        $contract->operation_area_id=$operationArea->id;
        $contract->status='1';
        $contract->start_date=$request->start_date;
        $contract->end_date=$request->end_date;
        $contract->attachment=$attachment;
//        dd($request->all());
        $contract->save();
        return redirect()->back()->with('success','Contract Store Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContractRequest  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract = Contract::findOrFail($request->input('ContractId'));
        $contract->status=$request->status;
        $contract->start_date=$request->start_date;
        $contract->end_date=$request->end_date;

        if ($request->hasFile('attachment'))
        {
            $destination = 'public/contract/attachments'.$contract->attachment;
            if(Storage::exists($destination)){
                Storage::delete($destination);
            }
            $dir = 'public/contract/attachments';
            $path = $request->file('attachment')->store($dir);
            $attachment= str_replace($dir,'',$path);
            $contract->attachment=$attachment;
        }

        $contract->save();
        return redirect()->back()->with('success','Contract updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contract $contract,$id)
    {
        try {
            $contract = Contract::find($id);
            $contract->delete();
            return redirect()->back()->with('success','Contract deleted Successfully');
        }catch (Exception $exception){
            info($exception);
        }
        return redirect()->back()->with('error','Contract can not be deleted');
    }

    public function download(Request $request,$id){
        $contract = Contract::findOrFail($id);
        return Storage::download('public/contract/attachments' . $contract->attachment);

//        $filePath = storage_path('public/contract/attachments' . $contract->attachment);
//        return response()->download($filePath);
    }
}
