<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Exports\RequestsExport;
use App\Http\Requests\ValidateAppRequest;
use App\Models\Customer;
use App\Models\District;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\OperationArea;
use App\Models\PaymentDeclaration;
use App\Models\Request;
use App\Models\Request as AppRequest;
use App\Models\RequestType;
use App\Models\RoadCrossType;
use App\Models\RoadType;
use App\Models\Sector;
use App\Models\User;
use App\Models\WaterNetwork;
use App\Models\WaterUsage;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use LaravelIdea\Helper\App\Models\_IH_Customer_C;
use LaravelIdea\Helper\App\Models\_IH_Customer_QB;
use LaravelIdea\Helper\App\Models\_IH_OperationArea_C;
use LaravelIdea\Helper\App\Models\_IH_RequestType_C;
use LaravelIdea\Helper\App\Models\_IH_RequestType_QB;
use LaravelIdea\Helper\App\Models\_IH_Sector_C;
use LaravelIdea\Helper\App\Models\_IH_Sector_QB;
use LaravelIdea\Helper\App\Models\_IH_WaterUsage_C;
use LaravelIdea\Helper\App\Models\_IH_WaterUsage_QB;
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
        $customerId = \request('cus_id');
        $startDate = \request('start_date');
        $endDate = \request('end_date');
        $districtId = \request('district_id');
        $operatorId = \request('operator_id');
        $opAreaId = \request('operation_area_id');

        $data = AppRequest::query()
            ->with(['customer', 'requestType', 'operator'])
            ->when(! is_null($customerId), function (Builder $query) use ($customerId) {
                return $query->where('customer_id', '=', decryptId($customerId));
            })
            ->when(isForOperationArea(), function (Builder $query) {
                return $query->where('operation_area_id', '=', auth()->user()->operation_area);
            })
            ->when(! is_null($startDate) && ! is_null($endDate), function (Builder $query) use ($startDate, $endDate) {
                return $query->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);
            })
            ->when(! is_null($districtId), function (Builder $query) use ($districtId) {
                return $query->where('district_id', '=', $districtId);
            })
            ->when(! is_null($operatorId), function (Builder $query) use ($operatorId) {
                return $query->where('operator_id', '=', $operatorId);
            })
            ->when(! is_null($opAreaId), function (Builder $query) use ($opAreaId) {
                return $query->where('operation_area_id', '=', $opAreaId);
            })
            ->select('requests.*');
        if (request()->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    $buttons = '';

                    if ($row->status == AppRequest::PENDING && auth()->user()->can(Permission::CreateRequest) && isForOperationArea()) {
                        $buttons = '<a class="dropdown-item js-edit" href="'.route('admin.requests.edit', encryptId($row->id)).'">
                                        <i class="fas fa-edit"></i>
                                        <span class="ml-2">Edit</span>
                                    </a>
                                    <a class="dropdown-item js-delete" href="'.route('admin.requests.delete', encryptId($row->id)).'">
                                        <i class="fas fa-trash"></i>
                                        <span class="ml-2">Delete</span>
                                    </a>';
                    }

                    return '<div class="dropdown">
                                 <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu border">
                                    <a class="dropdown-item" href="'.route('admin.requests.show', encryptId($row->id)).'">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="ml-2">Details</span>
                                    </a>

                                    '.$buttons.'

                                </div>
                            </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        $customer = ! empty($customerId) ? Customer::find(decryptId($customerId)) : null;

        return view('admin.requests.index', [
            'customer' => $customer,
        ]);
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
                    ['operation_area_id', '=', auth()->user()->operation_area],
                ])
                ->whereDoesntHave('requestAssignments')
                ->select('requests.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    return ' <a class="btn btn-sm btn-primary rounded" href="'.route('admin.requests.show', encryptId($row->id)).'">
                                <span class="">Details</span>
                             </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = $this->getUsersToAssign();

        return view('admin.requests.new_requests', [
            'users' => $users,
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
                    ['status', '=', AppRequest::ASSIGNED],
                ])
                ->whereHas('requestAssignment')
                ->select('requests.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    return ' <a class="btn btn-sm btn-primary rounded" href="'.route('admin.requests.show', encryptId($row->id)).'">
                                <span class="">Details</span>
                             </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $users = $this->getUsersToAssign();

        return view('admin.requests.assigned_requests', [
            'users' => $users,
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(ValidateAppRequest $request)
    {
        $data = $request->validated();

        $opArea = OperationArea::query()->find(auth()->user()->operation_area);
        $district = District::query()->find($opArea->district_id);

        $data['operator_id'] = auth()->user()->operator_id;
        $data['operation_area_id'] = auth()->user()->operation_area;
        $data['created_by'] = auth()->id();
        $data['province_id'] = $district->province_id;
        $data['district_id'] = $district->id;
        $data['request_type_id'] = RequestType::NEW_CONNECTION;
        unset($data['road_cross_types']);

        if ($request->hasFile('upi_attachment')) {
            $dir = $request->file('upi_attachment')->store(Request::UPI_ATTACHMENT_PATH);
            $data['upi_attachment'] = basename($dir);
        }

        DB::beginTransaction();
        $req = AppRequest::query()->create($data);
        $road_cross_types = $request->input('road_cross_types', []);
        foreach ($road_cross_types as $road_cross_type) {
            $req->pipeCrosses()->create([
                'road_cross_type_id' => $road_cross_type,
            ]);
        }
        // save flow history
        $this->saveFlowHistory($req, 'Request created by '.auth()->user()->name);
        DB::commit();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Request saved successfully',
                'status' => 'success',
            ], ResponseAlias::HTTP_OK);
        }

        $detailsRoute = route('admin.requests.show', encryptId($req->id));

        return redirect()->route('admin.requests.create')
            ->with('success', 'Request saved successfully <a class="btn btn-sm" href="'.$detailsRoute.'">View Details</a>');

    }

    public function show(AppRequest $request)
    {
        $request->load('customer', 'requestType', 'province', 'roadCrossType', 'waterUsage', 'requestAssignments', 'flowHistories.user', 'paymentDeclarations.paymentConfig.paymentType', 'paymentDeclarations.paymentHistories.mapping.account.paymentServiceProvider', 'meterNumbers.item', 'meterNumbers.itemCategory', 'pipeCrosses.pipeCross');

        $reviews = $request->flowHistories->where('is_comment', '=', true);
        $flowHistories = $request->flowHistories->where('is_comment', '=', false);

        $requestItems = $request->items()
            ->with('item')
            ->get();

        $items = Item::query()
            ->whereHas('category', fn (Builder $query) => $query->where('is_meter', '=', false))
            ->whereHas('stock', fn (Builder $query) => $query->where('quantity', '>', 0))
            ->orderBy('name')
            ->get();

        $waterNetworks = WaterNetwork::query()
            ->where('operation_area_id', '=', auth()->user()->operation_area)
            ->get();

        $itemCategories = ItemCategory::query()
            ->whereHas('items')
            ->where([
                ['is_meter', '=', true],
                ['operator_id', '=', auth()->user()->operator_id],
            ])
            ->get();

        return view('admin.requests.show', [
            'request' => $request,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories,
            'items' => $items,
            'requestItems' => $requestItems,
            'waterNetworks' => $waterNetworks,
            'itemCategories' => $itemCategories,
        ]);
    }

    public function destroy(AppRequest $request)
    {
        $request->delete();

        return response()->json([
            'message' => 'Request deleted successfully',
            'status' => 'success',
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @throws Throwable
     */
    public function update(ValidateAppRequest $request, AppRequest $appRequest)
    {
        $data = $request->validated();
        DB::beginTransaction();
        unset($data['road_cross_types']);

        if ($request->hasFile('upi_attachment')) {

            if ($appRequest->upi_attachment) {
                Storage::delete(Request::UPI_ATTACHMENT_PATH.'/'.$appRequest->upi_attachment);
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
        $this->saveFlowHistory($appRequest, 'Request updated by '.auth()->user()->name);

        DB::commit();

        $detailsRoute = route('admin.requests.show', encryptId($appRequest->id));

        return redirect()
            ->to($detailsRoute)
            ->with('success', 'Request updated successfully');
    }

    public function edit(AppRequest $request)
    {
        if ($request->status != AppRequest::PENDING) {
            return redirect()->back()->with('error', 'Request cannot be edited');
        }

        $operationArea = $this->getOperationArea();
        $sectors = $this->getSectors($operationArea);
        $requestTypes = $this->getRequestsTypes();
        $customers = $this->getCustomers();
        $waterUsage = $this->getWaterUsages();
        $roadTypes = $this->getRoadTypes();

        $selected_road_cross_types = $request->pipeCrosses()->pluck('road_cross_type_id')->toArray();

        return view('admin.requests.create', [
            'request' => $request,
            'sectors' => $sectors,
            'requestTypes' => $requestTypes,
            'customers' => $customers,
            'waterUsage' => $waterUsage,
            'roadTypes' => $roadTypes,
            'roadCrossTypes' => $this->getRoadCrossTypes(),
            'selected_road_cross_types' => $selected_road_cross_types,
        ]);
    }

    public function create()
    {
        $operationArea = $this->getOperationArea();
        $sectors = $this->getSectors($operationArea);
        $requestTypes = $this->getRequestsTypes();
        $customers = $this->getCustomers();
        $waterUsage = $this->getWaterUsages();
        $roadTypes = $this->getRoadTypes();

        return view('admin.requests.create', [
            'sectors' => $sectors,
            'requestTypes' => $requestTypes,
            'customers' => $customers,
            'waterUsage' => $waterUsage,
            'roadTypes' => $roadTypes,
            'roadCrossTypes' => $this->getRoadCrossTypes(),
        ]);
    }

    public function saveFlowHistory(AppRequest $req, $message): void
    {
        $req->flowHistories()
            ->create([
                'type' => $req->getClassName(),
                'status' => 'Pending',
                'user_id' => auth()->id(),
                'comment' => $message,
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
                            ->whereHas('requestAssignment', fn (Builder $builder) => $builder->where('user_id', '=', auth()->id()));
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
                    return '<a class="btn btn-sm btn-primary rounded" href="'.route('admin.requests.show', encryptId($row->id)).'">
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
                ['operation_area', '=', auth()->user()->operation_area],
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
                    $builder->whereIn(DB::raw('lower(status)'), [PaymentDeclaration::ACTIVE]);
                })
                ->whereIn('status', [AppRequest::METER_ASSIGNED, AppRequest::PARTIALLY_DELIVERED, AppRequest::DELIVERED])
                ->select('requests.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    $print = '';
                    if ($row->status == AppRequest::DELIVERED) {
                        $print = '<a class="dropdown-item" target="_blank" href="'.route('admin.requests.print-receipt', encryptId($row->id)).'">Print</a>';
                    }

                    return '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    '.$print.'
                                    <a class="dropdown-item" href="'.route('admin.requests.delivery-request.index', encryptId($row->id)).'">Deliveries</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.requests.item_delivery');
    }

    /**
     * @return OperationArea|OperationArea[]|\Illuminate\Database\Eloquent\Collection|Model|_IH_OperationArea_C|null
     */
    public function getOperationArea()
    {
        return OperationArea::find(auth()->user()->operation_area);
    }

    /**
     * @return Sector[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection|_IH_Sector_C|_IH_Sector_QB[]
     */
    public function getSectors($operationArea)
    {
        return Sector::query()
            ->where('district_id', '=', $operationArea->district_id)
            ->orderBy('name')
            ->get();
    }

    /**
     * @return RequestType[]|Builder[]|\Illuminate\Database\Eloquent\Collection|_IH_RequestType_C|_IH_RequestType_QB[]
     */
    public function getRequestsTypes()
    {
        return RequestType::query()->where('is_active', '=', true)->get();
    }

    /**
     * @return Customer[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection|_IH_Customer_C|_IH_Customer_QB[]
     */
    public function getCustomers()
    {
        return Customer::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')->get();
    }

    /**
     * @return WaterUsage[]|Builder[]|\Illuminate\Database\Eloquent\Collection|_IH_WaterUsage_C|_IH_WaterUsage_QB[]
     */
    public function getWaterUsages()
    {
        return WaterUsage::query()->get();
    }

    public function getRoadTypes(): Collection
    {
        return RoadType::query()
            ->pluck('name');
    }

    /**
     * @return RoadCrossType[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_RoadCrossType_C|\LaravelIdea\Helper\App\Models\_IH_RoadCrossType_QB[]
     */
    public function getRoadCrossTypes()
    {
        return RoadCrossType::query()->get();
    }

    public function exportDataToExcel()
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
        $districtId = request('district_id');
        $operationAreaId = request('operation_area_id');
        $operatorId = request('operator_id');

        $now = now()->format('Y-m-d-H-i-s');
        $requestsExport = new RequestsExport($startDate, $endDate, $districtId, $operatorId, $operationAreaId);

        return $requestsExport
            ->download("requests_$now.xlsx");
    }
}
