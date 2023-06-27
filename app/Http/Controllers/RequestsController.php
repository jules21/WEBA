<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Constants\Status;
use App\Exports\RequestsExport;
use App\Http\Requests\ValidateAppRequest;
use App\Models\Customer;
use App\Models\District;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\OperationArea;
use App\Models\Operator;
use App\Models\PaymentDeclaration;
use App\Models\PaymentType;
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
        $requestType = \request('request_type');
        $status = \request('request_status');
        $upi = \request('upi');

        $data = AppRequest::query()
            ->with(['customer', 'requestType', 'operator', 'operationArea', 'waterUsage'])
            ->when(!is_null($customerId), function (Builder $query) use ($customerId) {
                return $query->where('customer_id', '=', decryptId($customerId));
            })

            //if user has district_id then show only that district requests
            ->when(auth()->user()->district_id, function (Builder $query) {
                return $query->whereHas('operationArea', function (Builder $query) {
                    $query->where('district_id', '=', auth()->user()->district_id);
                });
            })
            ->when(auth()->user()->operator_id, function (Builder $query) {
                return $query->where('operator_id', '=', auth()->user()->operator_id);
            })
            ->when(isForOperationArea(), function (Builder $query) {
                return $query->where('operation_area_id', '=', auth()->user()->operation_area);
            })
            ->when((request()->has('start_date') && request()->filled('start_date')), function ($query) {
                $query->whereDate('created_at', '>=', request()->start_date);
            })
            ->when((request()->has('end_date') && request()->filled('end_date')), function ($query) {
                $query->whereDate('created_at', '<=', request()->end_date);
            })
            ->when(!is_null($districtId), function (Builder $query) use ($districtId) {
                return $query->where('district_id', '=', $districtId);
            })
            //operator_id
            ->when((request()->has('operator_id') && request()->filled('operator_id')), function ($query) {
                $query->where('operator_id', request()->operator_id);
            })
            //operation_area_id
            ->when((request()->has('operation_area_id') && request()->filled('operation_area_id')), function ($query) {
                $query->whereIn('operation_area_id', request()->operation_area_id);
            })
            ->when(!is_null($requestType), function (Builder $query) use ($requestType) {
                return $query->where('request_type_id', '=', $requestType);
            })
            ->when(!is_null($status), function (Builder $query) use ($status) {
                return $query->where('status', '=', $status);
            })
            ->when(!is_null($upi), function (Builder $query) use ($upi) {
                return $query->where('upi', '=', $upi);
            })
            ->select('requests.*');
        if (request()->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    $buttons = '';

                    if ($row->status == Status::PENDING && auth()->user()->can(Permission::CreateRequest) && isForOperationArea() && !$row->customer_initiated) {
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
        $customer = !empty($customerId) ? Customer::find(decryptId($customerId)) : null;

        //export
        if (request()->is_download == true && !\request()->ajax()) {
            return $this->exportDataToExcel($data->get());
        }

        return view('admin.requests.index', [
            'customer' => $customer,
            'requestTypes' => RequestType::all(),
            'requestStatuses' => Status::getRequestStatuses(),
            'operation_area_id' => $opAreaId,
            'operators' => Operator::query()->get(),
            'operationAreas' => auth()->user()->operator_id ?
                OperationArea::query()->where('operator_id', auth()->user()->operator_id)->get()
                : [],
        ]);
    }

    /**
     * @throws Exception
     */
    public function newRequests()
    {
        if (request()->ajax()) {
            $data = pendingRequestsBuilder()->select('requests.*');

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
                    ['status', '=', Status::ASSIGNED],
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
        $data['status'] = Status::SUBMITTED;
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
        $this->saveFlowHistory($req, 'Request created by ' . auth()->user()->name);
        DB::commit();

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Request saved successfully',
                'status' => 'success',
            ], ResponseAlias::HTTP_OK);
        }

        $detailsRoute = route('admin.requests.show', encryptId($req->id));

        return redirect()->route('admin.requests.create')
            ->with('success', 'Request saved successfully <a class="btn btn-sm" href="' . $detailsRoute . '">View Details</a>');

    }

    public function show(AppRequest $request)
    {
        $request->load('customer', 'requestType', 'province', 'roadCrossType', 'waterUsage', 'requestAssignments', 'flowHistories.user', 'paymentDeclarations.paymentConfig.paymentType', 'paymentDeclarations.paymentHistories.mapping.account.paymentServiceProvider', 'meterNumbers.item', 'meterNumbers.itemCategory', 'pipeCrosses.pipeCross');

        $reviews = $request->flowHistories->where('is_comment', '=', true);
        $flowHistories = $request->flowHistories->where('is_comment', '=', false);

        $requestItems = $request->items()
            ->with('item.stock.operationArea')
            ->get();

        $items = Item::query()
            ->with('stock.operationArea')
            ->whereHas('category', fn(Builder $query) => $query->where('is_meter', '=', false))
            ->whereHas('stock', fn(Builder $query) => $query->where('quantity', '>', 0))
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
        $paymentConfig = getPaymentConfiguration(PaymentType::CONNECTION_FEE, RequestType::NEW_CONNECTION);
        return view('admin.requests.show', [
            'request' => $request,
            'reviews' => $reviews,
            'flowHistories' => $flowHistories,
            'items' => $items,
            'requestItems' => $requestItems,
            'waterNetworks' => $waterNetworks,
            'itemCategories' => $itemCategories,
            'paymentConfig' => $paymentConfig,
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
            $this->saveFlowHistory($appRequest, 'Request Re-submitted by ' . auth()->user()->name, Status::ASSIGNED);
        } else {
            $this->saveFlowHistory($appRequest, 'Request updated by ' . auth()->user()->name);
        }


        DB::commit();

        $detailsRoute = route('admin.requests.show', encryptId($appRequest->id));

        return redirect()
            ->to($detailsRoute)
            ->with('success', 'Request updated successfully');
    }

    public function edit(AppRequest $request)
    {
        if ($request->status != Status::PENDING) {
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

    /**
     * @throws Exception
     */
    public function myTasks()
    {
        if (request()->ajax()) {
            $data = myTasksRequestBuilder()
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
                ->whereIn('status', [Status::METER_ASSIGNED, Status::PARTIALLY_DELIVERED, Status::DELIVERED])
                ->select('requests.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (AppRequest $row) {
                    $print = '';
                    if ($row->status == Status::DELIVERED) {
                        $print = '<a class="dropdown-item" target="_blank" href="' . route('admin.requests.print-receipt', encryptId($row->id)) . '">Print</a>';
                    }

                    return '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    ' . $print . '
                                    <a class="dropdown-item" href="' . route('admin.requests.delivery-request.index', encryptId($row->id)) . '">Deliveries</a>
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
     * @return Customer[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection|_IH_Customer_C|_IH_Customer_QB[]
     */
    public function getCustomers()
    {
        return Customer::query()
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->orderBy('name')->get();
    }

    public function exportDataToExcel($data)
    {
        $now = now()->format('Y-m-d-H-i-s');
        $requestsExport = new RequestsExport($data);
        return $requestsExport
            ->download("requests_$now.xlsx");
    }

}
