<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Operator;
use App\Models\Supplier;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $operators = Operator::all();
        $suppliers = Supplier::with('operator')->orderBy('id', 'DESC')->get();
        return view('admin.settings.suppliers', compact('suppliers', 'operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSupplierRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = new Supplier();
        $supplier->operator_id = $request->operator_id;
        $supplier->name = $request->name;
        $supplier->phone_number = $request->phone_number;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->contact_name = $request->contact_name;
        $supplier->contact_email = $request->contact_email;
        $supplier->save();

        if ($request->ajax()){



        }

        return redirect()->back()->with('success', 'Supplier Created Successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSupplierRequest $request
     * @param Supplier $supplier
     * @return RedirectResponse
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier = Supplier::findOrFail($request->input('SupplierId'));
        $supplier->operator_id = $request->operator_id;
        $supplier->name = $request->name;
        $supplier->phone_number = $request->phone_number;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->contact_name = $request->contact_name;
        $supplier->save();
        return redirect()->back()->with('success', 'Supplier updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Supplier $supplier
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Supplier $supplier, $id)
    {
        try {
            $supplier = Supplier::find($id);
            $supplier->delete();
            return redirect()->back()->with('success', 'Supplier deleted Successfully');
        } catch (Exception $exception) {
            info($exception);
            return redirect()->back()->with('success', 'Supplier can not be deleted');
        }
    }
}
