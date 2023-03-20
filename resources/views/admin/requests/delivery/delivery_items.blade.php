@extends('layouts.master')
@section('title',"Delivery Items")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Deliveries
                </h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.requests.delivery-request.index',encryptId($request->id)) }}"
                           class="text-muted">
                            Item Delivery
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                          Items
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
                <a href="{{ route('admin.requests.print-delivery',encryptId($delivery->id)) }}" target="_blank" class="btn btn-light-danger rounded-pill btn-sm font-weight-bolder">
                    <i class="la la-print"></i>
                    Print Delivery Note
                </a>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <div class="font-weight-bolder">
                    Customer Name:
                </div>
                <div>
                    {{ $request->customer->name }}
                </div>
            </div>

            <div class="mb-3">
                <div class="font-weight-bolder">
                    Customer Phone:
                </div>
                <div>
                    {{ $request->customer->phone }}
                </div>
            </div>

            <div class="table-responsive my-4">
                <table class="table table-head-custom table-head-solid">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delivery->details->where('quantity','>',0) as $item)
                        <tr>
                            <td>{{ $item->requestItem->item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->requestItem->unit_price) }}</td>
                            <td>{{  number_format($item->total ) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-weight-bold">Total</td>
                        <td class="font-weight-bold">{{ number_format($delivery->details->sum('total')) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mb-3">
                <div class="font-weight-bolder">
                    Delivered By Name:
                </div>
                <div>
                    {{ $delivery->delivered_by_name }}
                </div>
            </div>

            <div class="mb-3">
                <div class="font-weight-bolder">
                    Delivered By Phone:
                </div>
                <div>
                    {{ $delivery->delivered_by_phone }}
                </div>
            </div>
        </div>
    </div>

@endsection
