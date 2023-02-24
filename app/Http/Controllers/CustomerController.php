<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\IdType;
use App\Models\LegalType;
use App\Models\Province;
use DataTables;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{

    public function index()
    {
        $data = Customer::with(['legal', 'province', 'district', 'sector'])
            ->select('customers.*');

        if (request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                /*    -> editColumn('name', function (Customer $row) {
                        return '<a href="' . route('admin.customer.show', encryptId($row->id)) . '">' . $row->name . '</a>';
                    })*/
                ->addColumn('action', function (Customer $row) {

                    return '<div class="dropdown">
                                                 <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                    Options
                                                </button>
                                                <div class="dropdown-menu border">
                                                    <a class="dropdown-item" href="' . route('admin.customer.edit', encryptId($row->id)) . '">
                                                        <i class="fas fa-edit"></i>
                                                        <span class="ml-2">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item js-delete" href="' . route('admin.customer.delete', encryptId($row->id)) . '">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="ml-2">Delete</span>
                                                    </a>
                                                </div>
                                            </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        $legalTypes = LegalType::all();
        $provinces = Province::all();
        return view('admin.customers.index', [
            'legalTypes' => $legalTypes,
            'provinces' => $provinces,
            'idTypes' => IdType::get()
        ]);
    }


    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::query()
            ->create($data);

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
