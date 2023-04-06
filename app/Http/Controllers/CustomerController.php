<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\DocumentType;
use App\Models\LegalType;
use App\Models\Province;
use DataTables;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use LaravelIdea\Helper\App\Models\_IH_Customer_QB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    public function fetchIdentificationFromNIDA()
    {
        $id = request('id');
        $idType = request('id_type');

        $customer = $this->getCustomer($idType, $id);

        if (! is_null($customer)) {
            return \response()->json([
                'content' => 'Customer with provided ID Number already exists',
                'status' => 400,
            ]);
        }

        $url = config('services.CLMS_NIDA_URL')."?id=$id";
        $response = Http::get($url);
        if ($response->status() !== ResponseAlias::HTTP_OK) {
            return response()->json([
                'message' => 'Failed to fetch data from NIDA',
                'errors' => $response->json(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }

        return json_decode($response->body(), true);
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $data = Customer::with(['legalType', 'documentType'])
            ->where('operator_id', '=', auth()->user()->operator_id)
            ->withCount('connections');
        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Customer $row) {
                    return '<div class="dropdown">
                             <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Options
                            </button>
                            <div class="dropdown-menu border">
                                <a class="dropdown-item" href="' . route('admin.requests.create', ['c_id' => encryptId($row->id)]) . '">
                                    <i class="fas fa-plus mr-1"></i>
                                    <span class="ml-2">New Connection</span>
                                </a>
                                <a class="dropdown-item" href="' . route('admin.requests.index', ['cus_id' => encryptId($row->id)]) . '">
                                    <i class="fas fa-list mr-1"></i>
                                    <span class="ml-2">Requests</span>
                                </a>
                                <a class="dropdown-item" href="' . route('admin.customers.connections', encryptId($row->id)) . '">
                                    <i class="fas fa-link mr-1"></i>
                                    <span class="ml-2">Connections</span>
                                </a>
                                <a class="dropdown-item" href="' . route('admin.billings.customer', encryptId($row->id)) . '">
                                    <i class="fas fa-file-invoice  mr-1"></i>
                                    <span class="ml-2">Bills</span>
                                </a>
                                <a class="dropdown-item js-edit" href="' . route('admin.customers.show', encryptId($row->id)) . '">
                                    <i class="fas fa-edit mr-1"></i>
                                    <span class="ml-2">Edit</span>
                                </a>
                                <a class="dropdown-item js-delete" href="' . route('admin.customers.delete', encryptId($row->id)) . '">
                                    <i class="fas fa-trash mr-1"></i>
                                    <span class="ml-2">Delete</span>
                                </a>
                            </div>
                        </div>';
                })
                ->addColumn('connection', function (Customer $row) {
                    return '<a href="'.route('admin.customers.connections', encryptId($row->id)).'">

                                                    <span class="badge badge-primary">'.$row->connections_count.'</span>
                                                </a>';
                })
                ->rawColumns(['action', 'name', 'connection'])
                ->make(true);
        }
        $legalTypes = LegalType::all();
        $provinces = Province::all();

        return view('admin.customers.index', [
            'legalTypes' => $legalTypes,
            'provinces' => $provinces,
            'idTypes' => DocumentType::query()->get(),
        ]);
    }

    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        $id = $request->input('id');
        // remove input_doc_number from data
//        unset($data['input_doc_number']);
        $data['operator_id'] = auth()->user()->operator_id;
        if ($id > 0) {
            $customer = Customer::query()->find($id);
            $customer->update($data);
        } else {
            $customer = Customer::query()
                ->create($data);
        }

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Customer created successfully',
                'data' => $customer,
                'encrypted_id' => encryptId($customer->id),
            ], ResponseAlias::HTTP_CREATED);
        }

        return back()
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return $customer;
    }

    public function connections(Customer $customer)
    {
        $customer->load(['connections', 'connections.request',
            'connections.request.province', 'connections.request.district',
            'connections.request.sector', 'connections.request.cell']);

        return view('admin.customers.connections', [
            'customer' => $customer,
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Customer deleted successfully',
            ], ResponseAlias::HTTP_NO_CONTENT);
        }

        return back();
    }

    /**
     * @return Customer|Builder|Model|_IH_Customer_QB|object|null
     */
    public function getCustomer($idType, $id)
    {
        return Customer::query()
            ->where([
                ['document_type_id', '=', $idType],
                ['doc_number', '=', $id],
                ['operator_id', '=', auth()->user()->operator_id],
            ])->first();
    }
}
