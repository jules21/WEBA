<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateReviewRequest;
use App\Http\Requests\ValidateStoreItemRequest;
use App\Models\Request as AppRequest;
use App\Models\StockMovementDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
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

    public function storeItem(ValidateStoreItemRequest $itemRequest, AppRequest $request)
    {

        $data = $itemRequest->validated();

        $item = $request->items()
            ->updateOrCreate(
                ['item_id' => $data['item_id']],
                [
                    'quantity' => $data['quantity'],
                    'unit_price' => $data['unit_price'],
                    'type' => $request->getClassName(),
                    'status' => 'pending'
                ]
            );


        if ($itemRequest->ajax()) {
            return response()->json([
                'message' => 'Item saved successfully',
                'status' => 'success',
                'data' => $item
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()->back()
            ->with('success', 'Item saved successfully');

    }

    /**
     * @throws Throwable
     */
    public function deleteRequestItem(AppRequest $request, $id)
    {
        $id = decryptId($id);
        StockMovementDetail::query()->find($id)->delete();

        if (\request()->ajax()) {
            return response()->json([
                'message' => 'Item deleted successfully',
                'status' => 'success'
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()
            ->back()
            ->with('success', 'Item deleted successfully');

    }
}