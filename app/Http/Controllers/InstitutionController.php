<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Models\Institution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::query()->orderBy('id', 'DESC')->get();

        return view('admin.settings.institutions', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreInstitutionRequest $request)
    {
        $document = new Institution();
        $document->name = $request->name;
        $document->save();

        return redirect()->back()->with('success', 'Institution created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateInstitutionRequest $request, Institution $institution)
    {
        $document = Institution::find($request->input('InstitutionId'));
        $document->name = $request->name;
        $document->save();

        return redirect()->back()->with('success', 'Institution updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Institution $institution, $id)
    {
        try {
            $document = Institution::find($id);
            $document->delete();

            return redirect()->back()->with('success', 'Institution deleted Successfully');
        } catch (\Exception $exception) {
            info($exception);

            return redirect()->back()->with('error', 'Institution can not be deleted');
        }
    }
}
