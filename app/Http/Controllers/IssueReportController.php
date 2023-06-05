<?php

namespace App\Http\Controllers;

use App\Models\IssueReport;
use Illuminate\Http\Request;

class IssueReportController extends Controller
{

    public function reportedIssues()
    {
        return view('admin.issues.reported_issues');
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
