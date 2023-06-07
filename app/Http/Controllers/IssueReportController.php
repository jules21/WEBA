<?php

namespace App\Http\Controllers;

use App\Models\IssueReport;
use App\Models\Operator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IssueReportController extends Controller
{

    public function reportedIssues()
    {
        $issues = IssueReport::query()
            ->with(['details.model', 'operator', 'operatingArea', 'client'])
            ->when(isForOperationArea(), function (Builder $builder) {
                $builder->where('operator_id', auth()->user()->operator_id);
            })
            ->when(\request('operator'), function (Builder $builder) {
                $builder->where('operator_id', \request()->get('operator'));
            })
            ->when(\request('area'), function (Builder $builder) {
                $builder->where('operation_area_id', \request()->get('area'));
            })
            ->whereUserId(null)
            ->latest()
            ->paginate(10);

        $operators = Operator::query()
            ->with('operationAreas')
            ->whereHas('issues')
            ->get();
        return view('admin.issues.reported_issues', [
            'issues' => $issues,
            'operators' => $operators
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\IssueReport $issueReport
     * @return \Illuminate\Http\Response
     */
    public function show(IssueReport $issueReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\IssueReport $issueReport
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueReport $issueReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\IssueReport $issueReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueReport $issueReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\IssueReport $issueReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueReport $issueReport)
    {
        //
    }
}
