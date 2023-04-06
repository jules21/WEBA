<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateTechnicianRequest;
use App\Models\Request as AppRequest;
use App\Models\RequestTechnician;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RequestTechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(ValidateTechnicianRequest $technicianRequest, AppRequest $request)
    {
        $data = $technicianRequest->validated();

        $id = $technicianRequest->input('id');

        if ($id > 0) {
            $technician = RequestTechnician::query()->find($id);
            $technician->update($data);
        } else {
            $technician = $request->technician()
                ->updateOrCreate(
                    ['phone_number' => $data['phone_number']],
                    $data
                );
        }

        return back()
            ->with('success', 'Technician added successfully');

    }

    public function show(RequestTechnician $requestTechnician)
    {
        return $requestTechnician;
    }

    public function destroy($id)
    {
        $requestTechnician = RequestTechnician::query()->find(decryptId($id));

        $requestTechnician->delete();

        if (\request()->ajax()) {
            return \response()
                ->json();
        }

        return back()
            ->with('success', 'Technician deleted successfully');
    }
}
