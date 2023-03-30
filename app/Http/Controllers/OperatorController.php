<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Exports\OperatorsExport;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Models\LegalType;
use App\Models\Operator;
use App\Models\Province;
use Exception;
use Illuminate\Support\Facades\Http;
use Storage;
use Yajra\DataTables\DataTables;

class OperatorController extends Controller
{

    /**
     * @throws Exception
     */
    public function index()
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
        $districtId = request('district_id');

        $data = Operator::with(['legalType'])
            ->when($startDate, function ($query) use ($startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            })
            ->when($districtId, function ($query) use ($districtId) {
                return $query->where('district_id', $districtId);
            })
            ->withCount('operationAreas');

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Operator $row) {

                    $deleteBtn = '';
                    if ($row->operation_areas_count == 0) {
                        $deleteBtn = '  <a class="dropdown-item js-delete" href="' . route('admin.operator.delete', encryptId($row->id)) . '">
                                                         <i class="fas fa-trash"></i>
                                                         <span class="ml-2">Delete</span>
                                        </a>';
                    }
                    $opAreaBtn = '';

                    if (auth()->user()->can(Permission::ManageOperationAreas)) {
                        $opAreaBtn = '<a class="dropdown-item" href="' . route('admin.operator.area-of-operation.index', encryptId($row->id)) . '">
                                         <i class="fas fa-map"></i>
                                         <span class="ml-2">Area of Operations</span>
                                      </a>';
                    }

                    if (auth()->user()->can(Permission::ManageOperatorUsers)) {
                        $opAreaBtn .= '<a class="dropdown-item" href="' . route('admin.operator.users', encryptId($row->id)) . '">
                                         <i class="fas fa-users"></i>
                                         <span class="ml-2">Users</span>
                                      </a>';
                    }


                    return '<div class="dropdown">
                                 <button class="btn btn-light-primary rounded-sm btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Options
                                 </button>
                                 <div class="dropdown-menu border">
                                        ' . $opAreaBtn . '
                                        <a class="dropdown-item" href="' . route('admin.operator.details-page', encryptId($row->id)) . '">
                                         <i class="fas fa-info-circle "></i>
                                         <span class="ml-2">Details</span>
                                     </a>
                                     <a class="dropdown-item js-edit"
                                      data-address="' . $row->address . '"
                                      data-logo="' . $row->logo_url . '"
                                      href="' . route('admin.operator.update', encryptId($row->id)) . '">
                                         <i class="fas fa-edit"></i>
                                         <span class="ml-2">Edit</span>
                                     </a>
                                        ' . $deleteBtn . '

                                 </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $legalTypes = LegalType::all();
        $provinces = Province::all();

        return view('admin.operator.index', [
            'legalTypes' => $legalTypes,
            'provinces' => $provinces
        ]);
    }


    public function store(StoreOperatorRequest $request)
    {
        $data = $request->validated();
        $details = json_decode($request->input('operator_details'), true);

        $idType = $details['id_type'];
        $docNumber = $details['document_number'];

        // make id type and document number unique for each operator
        $operator = Operator::query()
            ->where('id_type', '=', $idType)
            ->where('doc_number', '=', $docNumber)
            ->first();

        if ($operator) {
            return response()->json([
                'success' => false,
                'message' => 'Operator with this ID type and Document Number already exists',
                'data' => $operator
            ], 400);
        }


        $operator = Operator::query()->create([
            'clms_id' => $details['id'],
            'name' => $details['name'],
            'legal_type_id' => $details['legal_type_id'],
            'id_type' => $idType,
            'doc_number' => $docNumber,
            'province_id' => $details['province_id'],
            'district_id' => $details['district_id'],
            'sector_id' => $details['sector_id'],
            'cell_id' => $data['cell_id'],
            'village_id' => $data['village_id'],
            'address' => $details['address']
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $operator,
                'message' => 'Operator created successfully'
            ]);
        }

        return redirect()->route('operator.index');
    }

    public function show(Operator $operator)
    {
        return response()->json([
            'success' => true,
            'data' => $operator
        ]);
    }

    public function update(UpdateOperatorRequest $request, Operator $operator)
    {
        $data = $request->validated();

        if ($request->file('logo')) {

            if (!is_null($operator->logo)) {
                Storage::delete(Operator::LOGO_PATH . $operator->logo);
            }
            $path = $request->file('logo')->store(Operator::LOGO_PATH);
            $data['logo'] = basename($path);
        }
        $operator->update($data);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $operator,
                'message' => 'Operator updated successfully'
            ]);
        }

        return redirect()->route('operator.index');
    }

    public function destroy(Operator $operator)
    {

        $operator->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Operator deleted successfully'
            ]);
        }

        return redirect()->route('operator.index');
    }

    public function operatorDetails()
    {
        $idType = request('identification_type');
        $idNumber = request('identification_number');
        $headers = [
            'CMS-RWSS-Key' => config('app.CMS-RWSS-Key'),
            'Content-Type' => 'application/json'
        ];
        $body = [
            "identificationType" => $idType/*"document_number"*/,
            "identificationNumber" => $idNumber/*"103058183"*/
        ];

        $response = Http::withHeaders($headers)
            ->post(config('app.CLMS_URL') . '/api/v1/cms-rwss/get-operator-details', $body);
        if ($response->status() == 200)
            return $response->json();
        return response()
            ->json([
                'message' => "Operator with the provided information does not exist"
            ], 400);
    }

    public function exportToExcel()
    {
        $now = now()->format('Y-m-d-H-i-s');
        $startDate = request('start_date');
        $endDate = request('end_date');
        $districtId = request('district_id');
        return (new OperatorsExport($startDate, $endDate,$districtId))
            ->download('operators-' . $now . '.xlsx');
    }

    public function details(Operator $operator)
    {
        $operator->load('province', 'district', 'sector', 'cell', 'village', 'legalType','operationAreas.district');
        return view('admin.operator.details', [
            'operator' => $operator
        ]);
    }

}
