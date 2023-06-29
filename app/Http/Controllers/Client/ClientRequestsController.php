<?php

namespace App\Http\Controllers\Client;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateAppRequest;
use App\Http\Requests\ValidateNewConnectionRequest;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Request;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ClientRequestsController extends Controller
{
    public function newConnection()
    {
        $operator = Operator::query()->findOrFail(\request('op_id'));
        $districtId = \request('district');
        $operationArea = OperationArea::query()
            ->where([
                ['operator_id', '=', $operator->id],
                ['district_id', '=', $districtId]
            ])->first();
        $sectors = $this->getSectors($operationArea);


        $requestTypes = $this->getRequestsTypes();
        $waterUsage = $this->getWaterUsages();
        $roadTypes = $this->getRoadTypes();

        $action = route('client.request-new-connection', encryptId($operator->id)) . '?op_id=' . encryptId($operationArea->id);
        return view('client.new_connections', [
            'operator' => $operator,
            'sectors' => $sectors,
            'requestTypes' => $requestTypes,
            'waterUsage' => $waterUsage,
            'roadTypes' => $roadTypes,
            'operationArea' => $operationArea,
            'action' => $action
        ]);
    }


    /**
     * @throws Throwable
     */
    public function requestNewConnection(ValidateNewConnectionRequest $connectionRequest, Operator $operator)
    {
        $data = $connectionRequest->validated();
        $sector_id = $data['sector_id'];
        $opId = decryptId(\request('op_id'));

        $operationArea = OperationArea::query()->findOrFail($opId);
        if (is_null($operationArea))
            return back()->with('error', 'No operation area found for this operator,please contact the operator for more information.')
                ->withInput($connectionRequest->all());

        if ($connectionRequest->hasFile('upi_attachment')) {
            $dir = $connectionRequest->file('upi_attachment')->store(Request::UPI_ATTACHMENT_PATH);
            $data['upi_attachment'] = basename($dir);
        }
        $data['request_type_id'] = RequestType::NEW_CONNECTION;
        DB::beginTransaction();

        $customer = $this->saveCustomer($operator);
        $request = Request::create([
            'operator_id' => $operator->id,
            'customer_id' => $customer->id,
            'operation_area_id' => $operationArea->id,
            'request_type_id' => $data['request_type_id'],
            'water_usage_id' => $data['water_usage_id'],
            'meter_qty' => $data['meter_qty'],
            'upi' => $data['upi'],
            'upi_attachment' => $data['upi_attachment'],
            'province_id' => $operationArea->district->province_id,
            'district_id' => $operationArea->district_id,
            'sector_id' => $sector_id,
            'cell_id' => $data['cell_id'],
            'village_id' => $data['village_id'],
            'description' => $data['description'],
            'new_connection_crosses_road' => $data['new_connection_crosses_road'],
            'road_type' => $data['new_connection_crosses_road'] == 0 ? null : $data['road_type'],
            'digging_pipeline' => $data['digging_pipeline'],
            'equipment_payment' => $data['equipment_payment'],
            'customer_initiated' => true,
            'status' => Status::SUBMITTED
        ]);

        $road_cross_types = $connectionRequest->input('road_cross_types', []);
        foreach ($road_cross_types as $road_cross_type) {
            $request->pipeCrosses()->create([
                'road_cross_type_id' => $road_cross_type,
            ]);
        }

        $this->saveFlowHistory($request, 'Request submitted by customer');

        DB::commit();
        return redirect()
            ->route('home')
            ->with('success', trans('app.your_request_has_been_submitted_successfully'));

    }

    private function saveCustomer(Operator $operator)
    {
        $client = auth('client')->user();
        $customer = $operator->findCustomerByDocNumber($client->doc_number);
        if ($customer)
            return $customer;

        return $operator->customers()
            ->create([
                'name' => $client->name,
                'legal_type_id' => $client->legal_type_id,
                'doc_number' => $client->doc_number,
                'phone' => $client->phone,
                'email' => $client->email,
                'province_id' => $client->province_id,
                'district_id' => $client->district_id,
                'sector_id' => $client->sector_id,
                'cell_id' => $client->cell_id,
                'village_id' => $client->village_id,
                'document_type_id' => $client->document_type_id,
            ]);
    }

    public function details(Request $request)
    {
        $lastReview = $request
            ->flowHistories()
            ->where('is_comment', '=', true)
            ->orderByDesc('id')
            ->first();

        $request->load(['customer', 'operator', 'operationArea', 'requestType', 'waterUsage', 'pipeCrosses.pipeCross','meterNumbers.item.stock','items.item']);
        return view('client.request_details', [
            'request' => $request,
            'lastReview' => $lastReview
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->status != Status::PENDING) {
            return redirect()->back()->with('error', 'Request cannot be edited');
        }

        $requestTypes = $this->getRequestsTypes();
        $waterUsage = $this->getWaterUsages();
        $roadTypes = $this->getRoadTypes();
        $roadCrossTypes = $this->getRoadCrossTypes();
        $operator = $request->operator;
        $operationArea = $request->operationArea;
        $sectors = $this->getSectors($operationArea);
        $selected_road_cross_types = $request->pipeCrosses()->pluck('road_cross_type_id')->toArray();
        $action = route('client.requests.update', encryptId($request->id));
        return view('client.new_connections', [
            'operator' => $operator,
            'sectors' => $sectors,
            'requestTypes' => $requestTypes,
            'waterUsage' => $waterUsage,
            'roadTypes' => $roadTypes,
            'roadCrossTypes' => $roadCrossTypes,
            'operationArea' => $operationArea,
            'request' => $request,
            'selected_road_cross_types' => $selected_road_cross_types,
            'action' => $action
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(ValidateNewConnectionRequest $request, AppRequest $appRequest)
    {
        $data = $request->validated();
        DB::beginTransaction();
        unset($data['road_cross_types']);

        if ($data['new_connection_crosses_road'] == 0) {
            $data['road_type'] = null;
        }

        if ($request->hasFile('upi_attachment')) {

            if ($appRequest->upi_attachment) {
                Storage::delete(Request::UPI_ATTACHMENT_PATH . '/' . $appRequest->upi_attachment);
            }

            $dir = $request->file('upi_attachment')->store(Request::UPI_ATTACHMENT_PATH);
            $data['upi_attachment'] = basename($dir);
        }

        $appRequest->update($data);
        $appRequest->pipeCrosses()->delete();
        $road_cross_types = $request->input('road_cross_types', []);
        foreach ($road_cross_types as $road_cross_type) {
            $appRequest->pipeCrosses()->create([
                'road_cross_type_id' => $road_cross_type,
            ]);
        }

        if ($appRequest->return_back_status == Status::RETURN_BACK) {
            $appRequest->update([
                'status' => Status::ASSIGNED,
                'return_back_status' => Status::RE_SUBMITTED,
            ]);
            $this->saveFlowHistory($appRequest, 'Request Re-submitted by customer', Status::ASSIGNED);
        } else {
            $this->saveFlowHistory($appRequest, 'Request updated by  customer');
        }


        DB::commit();

        $detailsRoute = route('client.request-details', encryptId($appRequest->id));

        return redirect()
            ->to($detailsRoute)
            ->with('success', 'Request updated successfully');
    }
}
