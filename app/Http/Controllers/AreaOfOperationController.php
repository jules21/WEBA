<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperationAreaRequest;
use App\Http\Requests\UpdateOperationAreaRequest;
use App\Models\OperationArea;
use App\Models\District;
use App\Models\Operator;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
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


    public function store(StoreOperationAreaRequest $request, Operator $operator)
    {
        $data = $request->validated();

        $id = $request->input('id');

        if ($id > 0) {
            $opArea = OperationArea::query()->find($id);
            $opArea->update($data);
        } else {
            $opArea = $operator
                ->operationAreas()
                ->create($data);
        }

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

        $operatorID = decryptId($id);
        info($operatorID);
        $body = [
            "operatorId" => $operatorID
        ];



        $response = Http::withHeaders($headers)
            ->post(config('app.CLMS_URL') . '/api/v1/cms-rwss/get-operator/operation-area', $body);

        if ($response->status() == 200)
            return $response->json();

        return response()
            ->json([
                'message' => 'Unable to fetch area of operations, please try again later',
            ], 400);

    }
}
