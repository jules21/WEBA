<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\ValidateAssignMeterNumber;
use App\Models\Item;
use App\Models\MeterRequest;
use App\Models\Request as AppRequest;
use DB;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class MeterRequestController extends Controller
{
    /**
     * @throws Throwable
     */
    public function store(ValidateAssignMeterNumber $validateAssignMeterNumber, AppRequest $request)
    {
        $data = $validateAssignMeterNumber->validated();
        $id = $validateAssignMeterNumber->input('id');


        $alreadyAddedMeters = $request->meterNumbers()
            ->where('item_id', '=', $data['item_id'])
            ->count();
        $inStockQty = Item::with('stock')->find($data['item_id'])->stock->quantity;

        if ($alreadyAddedMeters >= $inStockQty) {
            return response()->json([
                'message' => 'You have already added all the meters in stock',
                'status' => 'error',
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }


        DB::beginTransaction();
        if ($id > 0) {
            $meterRequest = MeterRequest::query()->find($id);
            $results = $meterRequest->update($data);
        } else {
            $data['balance'] = 0;
            $data['status'] = Status::ACTIVE;
            $data['subscription_number'] = Str::random(8);
            $results = $request->meterNumbers()
                ->create($data);
            $this->generateSubscriptionNumber($results);
        }

        DB::commit();

        if ($validateAssignMeterNumber->ajax()) {
            return response()->json([
                'message' => 'Meter number successfully saved',
                'status' => 'success',
                'data' => $results,
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()->back()
            ->with('success', 'Meter number successfully saved');

    }

    public function destroy($id)
    {
        $id = decryptId($id);

        MeterRequest::query()->find($id)->delete();

        if (\request()->ajax()) {
            return response()
                ->json(null, ResponseAlias::HTTP_NO_CONTENT);
        }

        return back();
    }

    private function generateSubscriptionNumber(MeterRequest $meterRequest): void
    {
        // generate  8 number prefixed with request id left padded with zeroes
        $subscriptionNumber = 'SN' . str_pad($meterRequest->id, 8, '0', STR_PAD_LEFT);
        $meterRequest->update([
            'subscription_number' => $subscriptionNumber,
        ]);
    }
}
