<?php

namespace App\Http\Controllers;

use App\Models\Request as AppRequest;
use App\Models\RequestDelivery;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws Exception
     */
    public function index(AppRequest $request)
    {
        if (\request()->ajax()) {
            $data = $request->deliveries();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $items = $request->items()->with('item')->get();
        $meterNumbers = $request->meterNumbers()->with('item')->get();

        return view('admin.requests.delivery.deliveries', [
            'request' => $request,
            'items' => $items,
            'meterNumbers' => $meterNumbers
        ]);
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param RequestDelivery $requestDelivery
     * @return Response
     */
    public function show(RequestDelivery $requestDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RequestDelivery $requestDelivery
     * @return Response
     */
    public function edit(RequestDelivery $requestDelivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RequestDelivery $requestDelivery
     * @return Response
     */
    public function update(Request $request, RequestDelivery $requestDelivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RequestDelivery $requestDelivery
     * @return Response
     */
    public function destroy(RequestDelivery $requestDelivery)
    {
        //
    }
}
