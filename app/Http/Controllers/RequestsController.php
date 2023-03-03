<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Http\Requests\ValidateAppRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Province;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use App\Models\RoadCrossType;
use App\Models\User;
use App\Models\WaterUsage;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class RequestsController extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {

        $data = AppRequest::query()
            ->with(['customer', 'requestType'])
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->select('requests.*');
        if (request()->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    $buttons = '';

                    if ($row->status == AppRequest::PENDING && auth()->user()->can(Permission::CreateRequest)) {
                        $buttons = '<a class="dropdown-item js-edit" href="' . route('admin.customers.show', encryptId($row->id)) . '">
                                        <i class="fas fa-edit"></i>
                                        <span class="ml-2">Edit</span>
                                    </a>
                                    <a class="dropdown-item js-delete" href="' . route('admin.customers.delete', encryptId($row->id)) . '">
                                        <i class="fas fa-trash"></i>
                                        <span class="ml-2">Delete</span>
                                    </a>';
                    }

                    return '<div class="dropdown">
                                 <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu border">
                                    <a class="dropdown-item" href="' . route('admin.requests.show', encryptId($row->id)) . '">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="ml-2">Details</span>
                                    </a>

                                    ' . $buttons . '

                                </div>
                            </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        return view('admin.requests.index');
    }

    /**
     * @throws Exception
     */
    public function newRequests()
    {
        if (request()->ajax()) {
            $data = AppRequest::query()
                ->with(['customer', 'requestType'])
                ->where('operator_id', '=', auth()->user()->operator_id)
                ->whereDoesntHave('requestAssignments')
                ->select('requests.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    return ' <a class="btn btn-sm btn-primary rounded" href="' . route('admin.requests.show', encryptId($row->id)) . '">
                                <span class="">Details</span>
                             </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = User::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            /*    ->whereHas('roles', function (Builder $query) {
                    $query->where('name', '=', 'Engineer');
                })*/
            ->get();
        return view('admin.requests.new_requests', [
            'users' => $users
        ]);
    }

    /**
     * @throws Exception
     */
    public function assignedRequests()
    {
        if (request()->ajax()) {
            $data = AppRequest::query()
                ->with(['customer', 'requestType', 'requestAssignment.user'])
                ->where([
                    ['operator_id', '=', auth()->user()->operator_id],
                    ['status', '=', AppRequest::ASSIGNED]
                ])
                ->whereHas('requestAssignment')
                ->select('requests.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    return ' <a class="btn btn-sm btn-primary rounded" href="' . route('admin.requests.show', encryptId($row->id)) . '">
                                <span class="">Details</span>
                             </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = User::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->get();
        return view('admin.requests.assigned_requests', [
            'users' => $users
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(ValidateAppRequest $request)
    {
        $data = $request->validated();

        $id = $request->input('id');
        $data['operator_id'] = auth()->user()->operator_id;
        $data['created_by'] = auth()->id();
        DB::beginTransaction();
        if ($id > 0) {
            $req = AppRequest::query()->find($id);
            $req->update($data);
        } else {
            $req = AppRequest::query()->create($data);
            // save flow history
            $this->saveFlowHistory($req);
        }

        DB::commit();

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
        $request->load('customer', 'requestType', 'province', 'roadCrossType', 'waterUsage', 'requestAssignments', 'flowHistories.user');

        $reviews = $request->flowHistories->where('is_comment', '=', true);
        $flowHistories = $request->flowHistories->where('is_comment', '=', false);

        $requestItems = $request->items()
            ->with('item')
            ->get();

        $items = Item::query()
            ->whereHas('category', fn(Builder $query) => $query->where('is_meter', '=', false))
            ->orderBy('name')
            ->get();

        $technician = $request->technician()->first();

        return view('admin.requests.show', [
            'request' => $request,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories,
            'items' => $items,
            'requestItems' => $requestItems,
            'technician' => $technician
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

    /**
     * @param AppRequest $req
     * @return void
     */
    public function saveFlowHistory(AppRequest $req): void
    {
        $req->flowHistories()
            ->create([
                'type' => $req->getClassName(),
                'status' => 'Pending',
                'user_id' => auth()->id(),
                'comment' => 'Request created by ' . auth()->user()->name
            ]);
    }


    /**
     * @throws Exception
     */
    public function myTasks()
    {
        if (request()->ajax()) {
            $data = AppRequest::query()
                ->with(['customer', 'requestType'])
                ->where([
                    ['operator_id', '=', auth()->user()->operator_id]
                ])
                ->where(function (Builder $builder) {
                    $hasPermission = false;
                    $user = auth()->user();
                    if ($user->can(Permission::ReviewRequest)) {
                        $hasPermission = true;
                        $builder
                            ->where('status', '=', AppRequest::ASSIGNED)
                            ->whereHas('requestAssignment', fn(Builder $builder) => $builder->where('user_id', '=', auth()->id()));
                    }

                    if ($user->can(Permission::ApproveRequest)) {
                        $hasPermission = true;
                        $builder->orWhere('status', '=', AppRequest::PROPOSE_TO_APPROVE);
                    }

                    if ($user->can(Permission::AssignMeterNumber)) {
                        $hasPermission = true;
                        $builder->orWhere('status', '=', AppRequest::APPROVED);
                    }

                    if ($hasPermission === false) {
                        $builder->where('requests.id', '=', 0);
                    }

                })
                ->whereHas('requestAssignment')
                ->select('requests.*');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    return '<a class="btn btn-sm btn-primary rounded" href="' . route('admin.requests.show', encryptId($row->id)) . '">
                                <span class="">Details</span>
                             </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.requests.my_requests');
    }

}
