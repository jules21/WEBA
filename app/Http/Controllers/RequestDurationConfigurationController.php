<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequestDurationConfiguration;
use App\Models\Operator;
use App\Models\RequestDurationConfiguration;
use Illuminate\Http\Request;

class RequestDurationConfigurationController extends Controller
{
    public function index(){
        $user = auth()->user();
          if ($user->is_super_admin){
              $configurations = RequestDurationConfiguration::with(['requestType','operator','operationArea'])->orderBy('id','DESC')->get();
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

        $configuration = RequestDurationConfiguration::find($id);
        $configuration->delete();
        return redirect()->back()->with('success','Request Duration Configuration deleted successfully');
    }
}
