@extends('layouts.master')

@section('title',"Customers Connections")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Customers</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Customer Connections</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="container">
        <div class="card card-body mb-3">
            <h3 class="mb-6">{{$customer->name}} connections</h3>
            <div class="table-responsive">
                <table class="table table-head-custom table-head-solid table-hover">
                    <thead>
                    <tr>
                        <th>Subscription Number</th>
                        <th>Meter Number></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($customer->connections as $item)
                        <tr>
                            <td>{{ $item->subscription_number }}</td>
                            <td>{{ $item->meter_number }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No meter numbers yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>
        </div>

    </div>
@endsection
