<?php

namespace App\Http\Controllers;

use App\Exports\RequestDurationConfigurationExport;
use App\Http\Requests\ValidateRequestDurationConfiguration;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\RequestDurationConfiguration;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RequestDurationConfigurationController extends Controller
{
    public function index(){
        $user = auth()->user();
          if ($user->is_super_admin){
              $startDate = request('start_date');
              $endDate = request('end_date');
              $operation_area_id = request('operation_area_id');
              $request_type_id = request('request_type_id');

              $configurations = RequestDurationConfiguration::with(['requestType','operator','operationArea'])
                  ->when(!empty($startDate), function (Builder $builder) use ($startDate) {
                      $builder->whereDate('created_at', '>=', $startDate);
                  })
                  ->when(!empty($endDate), function (Builder $builder) use ($endDate) {
                      $builder->whereDate('created_at', '<=', $endDate);
                  })
                  ->when(!empty($operation_area_id), function (Builder $builder) use ($operation_area_id) {
                      $builder->where('operation_area_id', $operation_area_id);
                  })
                  ->when(!empty($request_type_id), function (Builder $builder) use ($request_type_id) {
                      $builder->where('request_type_id', $request_type_id);
                  })
                  ->orderBy('id','DESC')
                  ->get();
              $operators = Operator::all();
          }else
              $configurations = RequestDurationConfiguration::with(['requestType','operator','operationArea'])
                  ->orderBy('id','DESC')
                  ->where('operator_id',$user->operator_id)->get();
              $operators = Operator::all();

        return view('admin.settings.request_duration_configurations',compact('configurations','operators'));
    }

    public function store(ValidateRequestDurationConfiguration $request){

        $request->validated();
        $configuration = new RequestDurationConfiguration();
        $configuration->request_type_id=$request->request_type_id;
        $configuration->operator_id=$request->operator_id;
        $configuration->operation_area_id=$request->operation_area_id;
        $configuration->processing_days=$request->processing_days;
        $configuration->is_active=$request->is_active;
//        return $configuration;
        $configuration->save();
        return redirect()->back()->with('success','Request Duration Configuration created successfully');
    }

    public function update(Request $request){

        $configuration = RequestDurationConfiguration::FindOrFail($request->input('ConfigurationId'));
        $configuration->request_type_id=$request->request_type_id;
        $configuration->operator_id=$request->operator_id;
        $configuration->operation_area_id=$request->operation_area_id;
        $configuration->processing_days=$request->processing_days;
        $configuration->is_active=$request->is_active;
        $configuration->save();
        return redirect()->back()->with('success','Request Duration Configuration updated successfully');
    }

    public function destroy($id){

        try {
            $configuration = RequestDurationConfiguration::find($id);
            $configuration->delete();
            return redirect()->back()->with('success','Request Duration Configuration deleted successfully');
        }catch (\Exception $exception){
            info($exception);
            return redirect()->back()->with('success','Request Duration Configuration can not be deleted');
        }
    }

    public function loadAreaOperation($id){
        $areas = OperationArea::where('operator_id',$id)->get();
        return response()->json($areas);
    }

    public function export(){
        return Excel::download(new RequestDurationConfigurationExport(), 'request-duration-configuration.xlsx');
    }
}
