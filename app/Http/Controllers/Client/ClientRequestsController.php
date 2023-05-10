<?php

namespace App\Http\Controllers\Client;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateNewConnectionRequest;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\Request;
use App\Models\RequestType;
use Illuminate\Support\Facades\DB;

class ClientRequestsController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function requestNewConnection(ValidateNewConnectionRequest $connectionRequest, Operator $operator)
    {
        $data = $connectionRequest->validated();
        $sector_id = $data['sector_id'];

        $operationArea = OperationArea::query()
            ->whereHas('district', function ($builder) use ($sector_id) {
                $builder->whereHas('sectors', function ($builder) use ($sector_id) {
                    $builder->where('id', '=', $sector_id);
                });
            })->first();
        if (is_null($operationArea))
            return back()->with('error', 'No operation area found for this sector')
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
            'road_type' => $data['road_type'],
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


        DB::commit();
        return redirect()
            ->route('home')
            ->with('success', 'Your request has been submitted successfully');

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
}
