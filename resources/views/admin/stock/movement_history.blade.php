@extends('layouts.master')
@section('title','Stock Movement Details')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Stock </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Stock Movement Details</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')
    <div class="">
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">
                    Stock Movement Details</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border table-hover table-head-custom table-vertical-center table-head-solid datatable">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Selling Price</th>
                            <th>Creation Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories as $movement)
                            <tr>
                                <td>{{ $movement->item->name }}</td>
                                <td>{{ $movement->quantity }} </td>
                                <td>{{ $movement->price }} RWF</td>
                                <td>{{ $movement->created_at }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
        $(document).ready(function () {
            $('.datatable').DataTable({
                responsive: true,
                "order": [[ 3, "desc" ]]
            });
            $('.nav-stock-managements').addClass('menu-item-active menu-item-open');
            $('.nav-stock-movements').addClass('menu-item-active');
        });

    </script>


@endsection
