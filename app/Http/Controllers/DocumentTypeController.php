<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use App\Models\DocumentType;
use App\Models\LegalType;

class DocumentTypeController extends Controller
{
    public function getByLegalType(LegalType $legalType)
    {
        return $legalType->documentTypes()->get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param \App\Http\Requests\StoreDocumentTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\DocumentType $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\DocumentType $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateDocumentTypeRequest $request
     * @param \App\Models\DocumentType $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\DocumentType $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        //
    }
}
