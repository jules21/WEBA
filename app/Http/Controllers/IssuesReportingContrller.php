<?php

namespace App\Http\Controllers;

use App\Models\IssueReport;
use App\Models\IssueReportDetail;
use App\Models\OperationArea;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IssuesReportingContrller extends Controller
{
    public function reportingIssues(){

        $issueReports = IssueReport::with('details.model')
            ->whereNotNull('user_id')
            ->get();
        return view('admin.issues.issues_reporting',compact('issueReports'));
    }

    public function store(Request $request){

     $issueReport = new IssueReport();
     $issueReport->title =$request->title;
     $issueReport->type ='OPERATOR';
     $issueReport->district_id = auth()->user()->district_id;
     $issueReport->user_id = auth()->user()->id;
     $issueReport->status = 'pending';
     $issueReport->save();

//     dd($issueReport);
        $issueReportingDetail = new IssueReportDetail();
        $issueReportingDetail->issue_report_id=$issueReport->id;
        $issueReportingDetail->user_id= auth()->user()->id;
        $issueReportingDetail->user_type= User::class;
        $issueReportingDetail->description= $request->description;
        $issueReportingDetail->save();

//     return $issueReport;

     return redirect()->back()->with('success','Issue Reporting Stored Successfully');

    }

    public function reply(Request $request,$id){


        $issueReport = IssueReport::find($id);
//        $issueReport->title =$request->title;
        $issueReport->status = $request->status;
        $issueReport->save();

//     dd($issueReport);
        $issueReportingDetail = new IssueReportDetail();
        $issueReportingDetail->issue_report_id=$issueReport->id;
        $issueReportingDetail->user_id= auth()->user()->id;
        $issueReportingDetail->user_type= User::class;
        $issueReportingDetail->description= $request->description;
        $issueReportingDetail->save();
        return redirect()->back()->with('success','Issue Reporting replied Successfully');
    }
}
