<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueReportingRequest;
use App\Http\Requests\StoreReplyIssueRequest;
use App\Models\IssueReport;
use App\Models\IssueReportDetail;
use App\Models\OperationArea;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Throwable;

class IssuesReportingController extends Controller
{
    public function reportingIssues()
    {

        $issueReports = IssueReport::with('details.model', 'operator')
            ->when(isForOperationArea(), function (Builder $builder) {
                $builder->where('operator_id', auth()->user()->operator_id);
            })
            ->when(!isOperator() && isDistrict(), function (Builder $builder) {
                $builder->where('district_id', auth()->user()->district_id);
            })
            ->whereNotNull('user_id')
            ->whereNull('client_id')
            ->latest()
            ->paginate(10);
        return view('admin.issues.issues_reporting', compact('issueReports'));
    }

    /**
     * @throws Throwable
     */
    public function store(IssueReportingRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $issueReport = new IssueReport();
        $issueReport->title = $data['title'];
        $issueReport->type = 'OPERATOR';
        $issueReport->district_id = auth()->user()->operator->district_id;
        $issueReport->operator_id = auth()->user()->operator_id;
        $issueReport->user_id = auth()->id();
        $issueReport->status = 'pending';
        $issueReport->save();

        $issueReportingDetail = new IssueReportDetail();
        $issueReportingDetail->issue_report_id = $issueReport->id;
        $issueReportingDetail->user_id = auth()->id();
        $issueReportingDetail->user_type = User::class;
        $issueReportingDetail->description = $data['description'];
        $issueReportingDetail->save();

        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Issue Reporting Stored Successfully');

    }

    /**
     * @throws Throwable
     */
    public function reply(StoreReplyIssueRequest $request, IssueReport $issueReport)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $issueReport->update([
            'status' => $data['status']
        ]);

        $issueReport->details()
            ->create([
                'user_id' => auth()->id(),
                'user_type' => User::class,
                'description' => $data['description'],
                'district_id' => auth()->user()->district_id
            ]);

        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'Issue Reporting replied Successfully');
    }
}
