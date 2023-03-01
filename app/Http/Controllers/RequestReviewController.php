<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateReviewRequest;
use App\Models\Request as AppRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class RequestReviewController extends Controller
{
    /**
     * @throws Throwable
     */
    public function saveReview(ValidateReviewRequest $reviewRequest, AppRequest $request)
    {
        $data = $reviewRequest->validated();

        DB::beginTransaction();

        $status = $data['status'];

        // update request
        $this->updateRequest($request, $status);
        // save review
        $this->saveHistory($request, $data['comment'], $status);

        DB::commit();

        return redirect()
            ->back()
            ->with('success', 'Review saved successfully');

    }

    /**
     * @param AppRequest $request
     * @param $comment
     * @param $status
     * @return void
     */
    public function saveHistory(AppRequest $request, $comment, $status): void
    {
        $request->flowHistories()->create([
            'comment' => $comment,
            'user_id' => auth()->id(),
            'is_comment' => true,
            'status' => $status,
            'type' => $request->getClassName()
        ]);
    }

    /**
     * @param AppRequest $request
     * @param $status
     * @return void
     */
    public function updateRequest(AppRequest $request, $status): void
    {
        $request->update([
            'status' => $status,
            'approval_date' => $status == AppRequest::APPROVED ? now() : null,
            'approved_by' => $status == AppRequest::APPROVED ? auth()->user()->id : null,
        ]);
    }
}
