<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperationAreaRequest;
use App\Http\Requests\UpdateOperationAreaRequest;
use App\Models\ChartAccount;
use App\Models\ChartAccountTemplate;
use App\Models\OperationArea;
use App\Models\District;
use App\Models\Operator;
use App\Models\Request;
use DB;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class AreaOfOperationController extends Controller
{

    /**
     * @throws Exception
     */
    public function index(Operator $operator)
    {
        $data = $operator->operationAreas()
            ->with('district')
            ->select('operation_areas.*');

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (OperationArea $row) {

                    return '<div class="dropdown">
                                                 <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                    Options
                                                 </button>
                                                 <div class="dropdown-menu border">
                                                     <a class="dropdown-item js-edit" href="' . route('admin.operator.area-of-operation.show', encryptId($row->id)) . '">
                                                         <i class="fas fa-edit"></i>
                                                         <span class="ml-2">Edit</span>
                                                     </a>
                                                     <a class="dropdown-item js-delete" href="' . route('admin.operator.area-of-operation.destroy', encryptId($row->id)) . '">
                                                         <i class="fas fa-trash"></i>
                                                         <span class="ml-2">Delete</span>
                                                     </a>
                                                 </div>
                                             </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $districts = District::query()->get();

        return view('admin.area-of-operation.index', [
            'operator' => $operator,
            'districts' => $districts
        ]);
    }


    /**
     * @throws Throwable
     */
    public function store(StoreOperationAreaRequest $request, Operator $operator)
    {
        $data = $request->validated();
        // check if the area of operation already exists
        $areaOfOperation = $operator->operationAreas()
            ->where([
                ['district_id', '=', $data['district_id'] ?? 0],
                ['id', '!=', $data['id'] ?? 0]
            ])
            ->first();

        if ($areaOfOperation) {
            return response()->json([
                'message' => 'Area of operation already exists',
                'success' => false,
                'data' => $areaOfOperation
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }


        $id = $request->input('id');
        DB::beginTransaction();
        if ($id > 0) {
            $opArea = OperationArea::query()->find($id);
            unset($data['district_id']);
            $opArea->update($data);
        } else {
            $opArea = $operator
                ->operationAreas()
                ->create($data);

            $this->saveChartOfAccounts($opArea);

        }
        DB::commit();

        if (request()->ajax()) {
            return \response()
                ->json([
                    'message' => 'Area of operation created successfully',
                    'success' => true,
                    'data' => $opArea
                ], ResponseAlias::HTTP_CREATED);
        }

        return back();
    }


    public function show(OperationArea $areaOfOperation)
    {
        $areaOfOperation->load('operator');
        return $areaOfOperation;
    }


    public function destroy(OperationArea $areaOfOperation)
    {
        $areaOfOperation->delete();

        if (request()->ajax())
            return response()->noContent();

        return back();
    }

    public function getAreaOfOperations($id)
    {
        $headers = [
            'CMS-RWSS-Key' => config('app.CMS-RWSS-Key'),
            'Content-Type' => 'application/json'
        ];

        $clmsOpId = decryptId($id);
        $operatorId = decryptId(\request('op_id'));
        $body = [
            "operatorId" => $clmsOpId
        ];

        $response = Http::withHeaders($headers)
            ->post(config('app.CLMS_URL') . '/api/v1/cms-rwss/get-operator/operation-area', $body);

        if ($response->status() == 200) {
            $json = $response->json();
            $operationAreas = OperationArea::query()
                ->where('operator_id', '=', $operatorId)
                ->get();
//            extract area_of_operations from the response json
            $areas = collect($json)->pluck('area_of_operations')->map(function ($item) {
                return $item[0];
            });

            $areaIds = $areas->pluck('district_id');
            // if all $operationAreas are in $areaIds, then return error message
            $existingOperationAreasIds = $operationAreas->pluck('district_id');

            if ($areaIds->diff($existingOperationAreasIds)->isEmpty()) {
                return \response()->json([
                    'message' => "No new area of operations found for this operator"
                ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            }

            // return $json excluding all registered $existingOperationAreasIds
            return collect($json)
                ->map(function ($item) use ($existingOperationAreasIds) {
                    $item['area_of_operations'] = collect($item['area_of_operations'])
                        ->filter(function ($area) use ($existingOperationAreasIds) {
                            return !$existingOperationAreasIds->contains($area['district_id']);
                        })->toArray();
                    return $item;
                })->toArray();
        }

        return response()
            ->json([
                'message' => 'Unable to fetch area of operations, please try again later',
                'data' => $response->json()
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

    }

    /**
     * @return mixed
     */
    public function getOperationAreasByOperators()
    {
        $operatorIds = request()->input('operator_id');
        $operators = Operator::query()->whereIn('id', $operatorIds)
            ->with('operationAreas')
            ->get();
        return $operators->map(function ($operator) {
            return $operator->operationAreas;
        });
    }

    /**
     * @param $opArea
     * @return void
     */
    public function saveChartOfAccounts($opArea): void
    {
        ChartAccountTemplate::query()
            ->each(function ($oldRecord) use ($opArea) {
                $newRecord = $oldRecord->replicate();
                // create new record with old record data and add operation_area_id to save as new chart of account
                $toArray = collect($newRecord->toArray())
                    ->except(['id', 'created_at', 'updated_at'])
                    ->toArray();

                ChartAccount::query()->create(
                    $toArray + [
                        'operation_area_id' => $opArea->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );

            });
    }


}
