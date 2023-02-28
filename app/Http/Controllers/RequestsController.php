<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAppRequest;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use App\Models\RoadCrossType;
use App\Models\WaterUsage;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Yajra\DataTables\Facades\DataTables;

class RequestsController extends Controller
{
    public function index()
    {
        $data = AppRequest::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->select('requests.*');
        if (request()->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Customer $row) {
                    return '<div class="dropdown">
                                 <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu border">
                                    <a class="dropdown-item js-edit" href="' . route('admin.customers.show', encryptId($row->id)) . '">
                                        <i class="fas fa-edit"></i>
                                        <span class="ml-2">Edit</span>
                                    </a>
                                    <a class="dropdown-item js-delete" href="' . route('admin.customers.delete', encryptId($row->id)) . '">
                                        <i class="fas fa-trash"></i>
                                        <span class="ml-2">Delete</span>
                                    </a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        return view('admin.requests.index');
    }

    public function store(ValidateAppRequest $request)
    {
        $data = $request->validated();

        $id = $request->input('id');
        $data['operator_id'] = auth()->user()->operator_id;
        $data['created_by'] = auth()->id();

        if ($id > 0) {
            $req = AppRequest::query()->find($id);
            $req->update($data);
        } else {
            AppRequest::query()->create($data);
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Request saved successfully',
                'status' => 'success'
            ], ResponseAlias::HTTP_OK);
        }

        return redirect()->route('admin.requests.index')
            ->with('success', 'Request saved successfully');

    }

    public function show(AppRequest $request)
    {

        return view('admin.requests.show', [
            'request' => $request
        ]);
    }

    public function destroy(AppRequest $request)
    {
        $request->delete();
        return response()->json([
            'message' => 'Request deleted successfully',
            'status' => 'success'
        ], ResponseAlias::HTTP_OK);
    }

    public function edit(AppRequest $request)
    {
        return view('admin.requests.edit', [
            'request' => $request
        ]);
    }

    public function update(ValidateAppRequest $request, AppRequest $appRequest)
    {
        $data = $request->validated();
        $appRequest->update($data);
        return redirect()->route('admin.requests.index');
    }

    public function create()
    {
        $provinces = Province::query()->get();
        $requestTypes = RequestType::query()->get();
        $customers = Customer::query()->orderBy('name')->get();
        $waterUsage = WaterUsage::query()->get();

        $roadTypes = [
            "Concreted",
            "Gravelled",
            "Dirt",
            "Paved",
            "Unpaved"
        ];

        return view('admin.requests.create', [
            'provinces' => $provinces,
            'requestTypes' => $requestTypes,
            'customers' => $customers,
            'waterUsage' => $waterUsage,
            'roadTypes' => $roadTypes,
            'roadCrossTypes' => RoadCrossType::query()->get()
        ]);
    }


}
