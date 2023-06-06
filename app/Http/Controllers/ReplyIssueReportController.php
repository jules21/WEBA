<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\StoreReplyIssueRequest;
use App\Models\IssueReport;
use App\Models\User;
use App\Notifications\IssueReportResolved;
use DB;
use Illuminate\Http\Request;
use Throwable;

class ReplyIssueReportController extends Controller
{
    /**
     * @throws Throwable
     */
    public function replyIssue(StoreReplyIssueRequest $request, IssueReport $issueReport)
    {
        $data = $request->validated();
        DB::beginTransaction();
        $issueReport->update([
            'status' => $data['status'],
        ]);

        $issueReport->details()->create([
            'description' => $data['description'],
            'user_id' => auth()->id(),
            'user_type' => User::class
        ]);
        DB::commit();

     /*   if ($issueReport->status == Status::RESOLVED) {
            $issueReport->client->notify(new IssueReportResolved($issueReport));
        }*/

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Issue Report has been replied successfully',
            ], 200);
        }

        return redirect()->back()->with('success', 'Issue Report has been replied successfully');
    }
}
