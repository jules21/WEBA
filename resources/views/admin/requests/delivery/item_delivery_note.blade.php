@extends('layouts.print')
@section('title',"Delivery Note")

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ asset('img/logo.svg') }}" style="height: 70px;" alt="" class="border py-2 mb-2"/>
                <div class="fw-bold">
                    Customer
                </div>
                <div class="mb-3">
                    <div>
                        {{ $request->customer->name }}
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        {{ $request->customer->address }}
                    </div>
                </div>
                <div class="mb-3">

                    <div>
                        {{ $request->customer->phone }}
                    </div>
                </div>
                <div class="mb-3">
                    <div class="font-weight-bolder">
                        Customer Email:
                    </div>
                    <div>
                        {{ $request->customer->email }}
                    </div>
                </div>
                <div class="mb-3">
                    <div class="font-weight-bolder">
                        Delivery Date:
                    </div>
                    <div>
                        {{ $delivery->delivery_date }}
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-danger btn-sm d-print-none px-4 mb-3" type="button" onclick="window.print();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                    </svg>
                    Print
                </button>
                <h1 class="text-primary fw-bold text-end">
                    Delivery Note
                </h1>

            </div>

        </div>
        <div class="mb-3">
            <div class="font-weight-bolder mb-3">
                Delivery Items:
            </div>
            <div>
                <table class="table table-head-custom table-head-solid border">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Qty Delivered</th>
                        <th>Qty Remaining</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delivery->details->where('quantity','>',0) as $item)
                        <tr>
                            <td>{{ $item->requestItem->item->name }}</td>
                            <td>{{ $item->requestItem->quantity }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->remaining }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <p class="small mb-0">
            Thank you for your business.
        </p>
        <p class="small">
            Please check all items carefully before signing this delivery note.
        </p>
        <div>
            Items received By : <strong>
                {{ $delivery->delivered_by_name }} <a class="ms-3 text-decoration-none"
                                                      href="tel:{{ $delivery->delivered_by_phone }}">{{ $delivery->delivered_by_phone }}</a>
            </strong>
        </div>
        <div class="mt-3">
            <p>
                Signature: <span style="width: 200px; display: inline-block;border-bottom:2px dashed ">&nbsp;</span>
            </p>
        </div>
    </div>

@endsection
