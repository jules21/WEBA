<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAssignRequest;
use App\Models\FlowHistory;
use App\Models\Request as AppRequest;
use App\Models\RequestAssignment;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class RequestAssignmentController extends Controller
{
    /**
     * @throws Throwable
     */
    public function assignRequests(ValidateAssignRequest $request)
    {
        $data = $request->validated();

        $requestIds = $data['request_ids'];
        $userId = $data['user_id'];

        $requestAssignments = [];

        DB::beginTransaction();
        foreach ($requestIds as $requestId) {
            $requestAssignments[] = [
                'request_id' => $requestId,
                'user_id' => $userId,
                'assigned_by' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $this->updateRequest($requestId);
        }

        RequestAssignment::insert($requestAssignments);

        DB::commit();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Requests assigned successfully',
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()->back()->with('success', 'Requests assigned successfully');

    }

    /**
     * @param $requestId
     * @return void
     */
    public function updateRequest($requestId): void
    {
        $appRequest = AppRequest::find($requestId);
        $appRequest->status = 'Assigned';
        $appRequest->save();
        $this->saveFlowHistory($appRequest);
    }

    /**
     * @param AppRequest $appRequest
     * @return void
     */
    public function saveFlowHistory(AppRequest $appRequest): void
    {
        // get class name without namespace
        $appRequest->flowHistories()
            ->create([
                'type' => $appRequest->getClassName(),
                'status' => 'Assigned',
                'user_id' => auth()->id(),
                'comment' => 'Request assigned  by ' . auth()->user()->name,
            ]);
    }
}
