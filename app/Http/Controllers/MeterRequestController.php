<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAssignMeterNumber;
use App\Models\MeterRequest;
use App\Models\Request as AppRequest;
use DB;
use Illuminate\Database\Eloquent\Model;
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
        DB::beginTransaction();
        if ($id > 0) {
            $results = $request->meterNumbers()
                ->update($data);
        } else {
            $data['balance'] = 0;
            $data['status'] = 'Pending';
            $data['subscription_number'] = Str::random(8);
            $results = $request->meterNumbers()
                ->create($data);
            $this->generateSubscriptionNumber($results);
        }

        DB::commit();

        if ($validateAssignMeterNumber->ajax()) {
            return response()->json([
                'message' => "Meter number successfully saved",
                'status' => 'success',
                'data' => $results
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
        $subscriptionNumber ="SN" . str_pad($meterRequest->request_id, 8, '0', STR_PAD_LEFT);
        $meterRequest->update([
            'subscription_number' => $subscriptionNumber
        ]);
    }
}
