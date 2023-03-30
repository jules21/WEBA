@extends('layouts.master')
@section('title', 'Payment Declarations')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Payments </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Payments</a>
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
    <div class="card">
        <div class="card-content card-custom">
            <div class="card-header pb-1 pt-3 d-flex justify-content-between">
                <h3>
                    Customers Payments</h3>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="nav flex-column nav-hover">
                                <li class="nav-item export-doc">
                                    <a href="#" class="nav-link" target="_blank" id="excel">
                                        <i class="nav-icon la la-file-excel-o"></i>
                                        <span class="nav-text">Excel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                </div>
            </div>
            <div class="card-body">
                @if(Str::contains(Route::currentRouteName(), 'admin.billings.index'))
                    <form action="#" id="filter-form">
                        <div class="row">
                            @unless(Helper::isOperator())
                                <div class="col-md-3 form-group">
                                    <label for="operator">Operator</label>
                                    <select name="operator_id[]" id="operator" class="form-control select2"
                                            data-placeholder="Select Operator" multiple="multiple">
                                        {{--                                    <option value="">Select Operator</option>--}}
                                        @foreach($operators ?? [] as $operator)
                                            <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endunless
                            @unless(Helper::hasOperationArea())
                                <div class="col-md-3 form-group">
                                    <label for="operation_area">Operation Area</label>
                                    <select name="operation_area_id[]" id="operation_area" class="form-control select2"
                                            data-placeholder="Select Operation Area" multiple="multiple">
                                        @foreach($operationAreas  ?? [] as $operationArea)
                                            <option value="{{ $operationArea->id }}">{{ $operationArea->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endunless
                            <div class="col-md-3 form-group">
                                <label for="items">Customer Field Officer</label>
                                <select name="customer_field_officer_id[]" id="customer_field_officer" class="form-control select2"
                                        data-placeholder="Select Customer Field Officer" multiple="multiple">
                                    @foreach($customerFieldOfficers ?? [] as $customerFieldOfficer)
                                        <option value="{{ $customerFieldOfficer->id }}"
                                            {{request()->get('customer_field_officer_id') == $customerFieldOfficer->id ? 'selected' : ''}}
                                        >{{ $customerFieldOfficer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Meter Number</label>
                                <input type="text" name="meter_number" id="meter_number" class="form-control" placeholder="Meter Number" value="{{request()->get('meter_number')}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Subscription Number</label>
                                <input type="text" name="subscription_number" id="subscription_number" class="form-control" placeholder="Subscription Number" value="{{request()->get('subscription_number')}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-search"></i>
                                    Filter</button>
                                <a href="{{route('admin.billings.index')}}" class="btn btn-outline-dark btn-sm"> clear search</a>
                            </div>
                        </div>
                    </form>
                    <hr>
                @endif
                <div class="table-responsive">
                    {{$dataTable->table(['class' => 'table table-head-custom border table-head-solid table-hover'])}}
                </div>

            </div>
        </div>
        @php
            //Declare new queries you want to append to string:
            $newQueries = ['is_download' => 1];
            $newUrl = request()->fullUrlWithQuery($newQueries);
        @endphp
    </div>
@endsection
@section('scripts')
    {{$dataTable->scripts()}}
    <script>
        $('.nav-payments').addClass('menu-item-active');
        $(document).on("click","#excel", function(e) {
            var url = "{!! $newUrl !!}";
            $(this).attr("href",url);
        });
    </script>
@endsection
