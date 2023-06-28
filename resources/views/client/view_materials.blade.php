@extends('layouts.print')
@section('title', 'Materials')
@section('content')
    <div class="container-fluid my-5">
        <div class=" overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center py-8 px-8">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-4 flex-column flex-md-row">
                            <div class="d-flex flex-column justify-content-between px-0">
                                <h1 class="font-weight-light mb-10">
                                    Materials
                                </h1>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">PRINT DATE</span>
                                    <span class="opacity-70">
                                        {{ now()->format('d/m/Y') }}
                                </span>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="{{ url('/') }}" class="mb-5">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                    <span>
                                        {{ $request->operator->name }} {{--, {{ $request->operator->province->name }}--}}
                                    </span>
                                    <span>
                                        {{ $request->operator->address}}
                                    </span>
								</span>
                            </div>
                        </div>
                        <div class=" w-100" style="border-bottom:1px dashed silver"></div>
                        <div class="d-flex justify-content-between pt-4">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">DATE</span>
                                <span class="opacity-70">
                                    {{ $request->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">
                                    PAYMENT REF.
                                </span>
                                <span class="opacity-70">{{$payDec->payment_reference??'N/A'}}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">MATERIALS TO.</span>
                                <span class="opacity-70">
                                    {{ $request->customer->name }}<br>{{ $request->customer->phone }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                <div class="row justify-content-center py-4 px-8 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th class="pl-0 font-weight-bold text-muted text-uppercase "
                                        style="border-bottom:1px dashed silver">Item
                                    </th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase "
                                        style="border-bottom:1px dashed silver">Qty
                                    </th>
                                    <th class="text-right font-weight-bold text-muted text-uppercase "
                                        style="border-bottom:1px dashed silver">Price
                                    </th>
                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase "
                                        style="border-bottom:1px dashed silver">Total
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($request->items as $material)
                                    <tr class="font-weight-normal">
                                        <td class="pl-0 pt-3">
                                            {{ $material->item->name }}
                                        </td>
                                        <td class="text-right pt-3">
                                            {{ $material->quantity }}
                                        </td>
                                        <td class="text-right pt-3">
                                            {{ number_format($material->unit_price) }}
                                        </td>
                                        <td class="text-dark font-weight-bold pr-0 pt-3 text-right">
                                            {{ number_format($material->total) }}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3" class="font-weight-bold text-muted text-uppercase text-right">
                                        Total
                                    </td>

                                    <td class="font-weight-bold text-dark text-uppercase text-right">
                                        RWF {{ number_format($request->items->sum('total')) }}
                                    </td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice body-->

                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-4 px-4 py-md-10 px-md-0  d-print-none">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                    <path
                                        d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                </svg>
                                Print List
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>

    </div>
@endsection
