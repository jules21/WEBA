<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\DocumentType;
use App\Models\IdType;
use App\Models\LegalType;
use App\Models\Province;
use DataTables;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    public function fetchIdentificationFromNIDA($id)
    {
        $response = Http::post("https://onlineauthentication.nida.gov.rw/onlineauthentication/claimtoken", [
            "username" => config('app.NIDA_USERNAME'),
            "password" => config('app.NIDA_PASSWORD')
        ]);
        $res = Http::withToken(explode(" ", $response->body())[1])
            ->post("https://onlineauthentication.nida.gov.rw/onlineauthentication/getcitizen", [
                "documentNumber" => $id,
                "keyPhrase" => config('app.NIDA_KEY_PHRASE')
            ]);
        return json_decode($res->body(), true);
    }


    public function index()
    {
        $data = Customer::with(['legalType', 'documentType'])
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
                                <a class="dropdown-item" href="' . route('admin.customers.connections', encryptId($row->id)) . '">
                                    <i class="fas fa-link"></i>
                                    <span class="ml-2">Connections</span>
                                </a>
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
                ->addColumn('connection', function (Customer $row) {
                    return '<a href="' . route('admin.customers.connections', encryptId($row->id)) . '">
                            <span class="badge badge-primary">' . $row->connections_count . '</span>
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
            'idTypes' => DocumentType::query()->get()
        ]);
    }


    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();
        $id = $request->input('id');
        if ($id > 0) {
            $customer = Customer::query()->find($id);

            $customer->update($data);
        } else {
            $customer = Customer::query()
                ->create($data);
        }

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Customer created successfully'
            ], ResponseAlias::HTTP_CREATED);
        }

        return back();
    }


    public function show(Customer $customer)
    {
        return $customer;
    }

    public function connections(Customer $customer)
    {
        return view('admin.customers.connections', [
            'customer' => $customer
        ]);
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Customer deleted successfully'
            ], ResponseAlias::HTTP_NO_CONTENT);
        }
        return back();
    }
}
