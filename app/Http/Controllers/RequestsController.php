<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Http\Requests\ValidateAppRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\PaymentConfiguration;
use App\Models\PaymentDeclaration;
use App\Models\PaymentType;
use App\Models\Province;
use App\Models\Request;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use App\Models\RoadCrossType;
use App\Models\RoadType;
use App\Models\User;
use App\Models\WaterNetwork;
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
            ->where([['operation_area_id', '=', auth()->user()->operation_area]])
            ->select('requests.*');
        if (request()->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    $buttons = '';

                    if ($row->status == AppRequest::PENDING && auth()->user()->can(Permission::CreateRequest)) {
                        $buttons = '<a class="dropdown-item js-edit" href="' . route('admin.requests.edit', encryptId($row->id)) . '">
                                        <i class="fas fa-edit"></i>
                                        <span class="ml-2">Edit</span>
                                    </a>
                                    <a class="dropdown-item js-delete" href="' . route('admin.requests.delete', encryptId($row->id)) . '">
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
                ->where([
                    ['operation_area_id', '=', auth()->user()->operation_area]
                ])
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

        $users = $this->getUsersToAssign();
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
                    ['operation_area_id', '=', auth()->user()->operation_area],
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

        $users = $this->getUsersToAssign();
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
        $data['operation_area_id'] = auth()->user()->operation_area;
        $data['created_by'] = auth()->id();

        if ($request->hasFile('upi_attachment')) {
            $dir = $request->file('upi_attachment')->store(Request::UPI_ATTACHMENT_PATH);
            $data['upi_attachment'] = basename($dir);
        }

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

        return redirect()->route('admin.requests.my-tasks')
            ->with('success', 'Request saved successfully');

    }

    public function show(AppRequest $request)
    {
        $request->load('customer', 'requestType', 'province', 'roadCrossType', 'waterUsage', 'requestAssignments', 'flowHistories.user', 'paymentDeclarations.paymentConfig.paymentType', 'meterNumbers.item', 'meterNumbers.itemCategory');

        $reviews = $request->flowHistories->where('is_comment', '=', true);
        $flowHistories = $request->flowHistories->where('is_comment', '=', false);

        $requestItems = $request->items()
            ->with('item')
            ->get();

        $items = Item::query()
            ->whereHas('category', fn(Builder $query) => $query->where('is_meter', '=', false))
            ->whereHas('stock', fn(Builder $query) => $query->where('quantity', '>', 0))
            ->orderBy('name')
            ->get();

        $waterNetworks = WaterNetwork::query()
            ->where('operation_area_id', '=', auth()->user()->operation_area)
            ->get();

        $itemCategories = ItemCategory::query()
            ->where('is_meter', '=', true)
            ->get();

        $paymentConfig = getPaymentConfiguration(PaymentType::CONNECTION_FEE, $request->request_type_id);

        return view('admin.requests.show', [
            'request' => $request,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories,
            'items' => $items,
            'requestItems' => $requestItems,
            'waterNetworks' => $waterNetworks,
            'itemCategories' => $itemCategories,
            'paymentConfig' => $paymentConfig
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

        $roadTypes = RoadType::query()
            ->pluck('name');

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
                    ['operation_area_id', '=', auth()->user()->operation_area],
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


    public function getUsersToAssign()
    {
        return User::query()
            ->where([
                ['operator_id', '=', auth()->user()->operator_id],
                ['operation_area', '=', auth()->user()->operation_area]
            ])
            ->get();
    }

    /**
     * @throws Exception
     */
    public function toBeDelivered()
    {
        if (request()->ajax()) {
            $data = AppRequest::query()
                ->with(['customer', 'requestType'])
                ->where([
                    ['operation_area_id', '=', auth()->user()->operation_area],
                ])
                ->whereDoesntHave('paymentDeclarations', function (Builder $builder) {
                    $builder->whereIn('status', [PaymentDeclaration::ACTIVE]);
                })
                ->whereIn('status', [AppRequest::METER_ASSIGNED, AppRequest::PARTIALLY_DELIVERED, AppRequest::DELIVERED])
                ->select('requests.*');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    return '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('admin.requests.show', encryptId($row->id)) . '">Print</a>
                                    <a class="dropdown-item" href="' . route('admin.requests.delivery-request.index', encryptId($row->id)) . '">Deliveries</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.requests.item_delivery');
    }

}
