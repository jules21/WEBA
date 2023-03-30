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
        <div class="card shadow-none border">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <h3 class="mb-3">
                        @if(Str::contains(Route::currentRouteName(), 'admin.billings.customer'))
                            {{ $customer->name ?? '' }}
                        @else
                            Customers
                        @endif
                        Payments</h3>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            {{--                            @if ($requests->count() > 0)--}}
                            <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i>Export</button>
                            {{--                            @endif--}}
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
                    <form action="#" id="filter-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">

                                    <label for="from_date">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control " placeholder="From Date" value="{{request()->get('from_date')}}">
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="to_date">To Date</label>
                                <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" value="{{request()->get('to_date')}}">
                            </div>
                            @unless(Helper::isOperator())
                                <div class="col-md-3 form-group">
                                    <label for="operator">Operator</label>
                                    <select name="operator_id" id="operator" class="form-control select2"
                                            data-placeholder="Select Operator">
                                        <option value="">Select Operator</option>
                                        @foreach($operators ?? [] as $operator)
                                            <option value="{{ $operator->id }}" {{request()->get('operator_id') == $operator->id ? 'selected' : ''}}>{{ $operator->name }}</option>
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
                                <label for="items">Request Type</label>
                                <select name="request_type" id="request_type" class="form-control select2"
                                        data-placeholder="Select Request Type">
                                    <option value="">Select Request Type</option>
                                    @foreach(\App\Models\RequestType::all() ?? [] as $requestType)
                                        <option value="{{ $requestType->id }}" {{request()->get('request_type') == $requestType->id ? 'selected' : ''}}>{{ $requestType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control select2"
                                        data-placeholder="Select Payment Type">
                                    <option value="">Select Payment Type</option>
                                    @foreach(\App\Models\PaymentType::all() ?? [] as $paymentType)
                                        <option value="{{ $paymentType->id }}" {{request()->get('payment_type') == $paymentType->id ? 'selected' : ''}}>{{ $paymentType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Reference Number</label>
                                <input type="text" name="reference_number" id="reference_number" class="form-control" placeholder="Reference Number" value="{{request()->get('reference_number')}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Status</label>
                                <select name="status" id="status" class="form-control select2"
                                        data-placeholder="Select Status">
                                    <option value="">Select Status</option>
                                    @foreach(Helper::paymentDeclarationStatuses() as $key => $status)
                                        <option value="{{ $key }}" {{request()->get('status') == $key ? 'selected' : ''}}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-search"></i>
                                    Filter</button>
                                <a href="{{route('admin.payments.index')}}" class="btn btn-outline-dark btn-sm"> clear search</a>
                            </div>
                        </div>
                    </form>
                    <hr>
{{--                @endif--}}
                <div class="table-responsive">
                    {{$dataTable->table(['class' => 'table table-head-custom border table-head-solid table-hover'])}}
                </div>
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
        $(document).ready(function (){
            $('.nav-payments').addClass('menu-item-active');
            initData();
            $(document).on("click","#excel", function(e) {
                var url = "{!! $newUrl !!}";
                $(this).attr("href",url);
            });
            $(document).on('change', '#operator', function (e) {
                e.preventDefault();
                let operatorId = $(this).val();
                if (operatorId !== '') {
                    getOperationArea(operatorId);
                }
                else {
                    $('#operation_area').empty();
                    $('#operation_area').append('<option value="">Select Operation Area</option>');
                }
            });
            $(document).on('change','#operation_area',function (e) {
                e.preventDefault();
                let operationAreaId = $(this).val();
                if (operationAreaId !== '') {
                    getCustomerFieldOfficer(operationAreaId);
                }
                else {
                    $('#customer_field_officer').empty();
                    $('#customer_field_officer').append('<option value="">Select Customer Field Officer</option>');
                }
            });
        })
        const initData = () => {
            const operatorId = "{{ request()->get('operator_id') ? request()->get('operator_id') : '' }}";
            const operationAreaId = @json($operation_area_id);
            if (operatorId !== '') {
                getOperationArea(operatorId);
            }
            if (operationAreaId !== '' && operationAreaId !== null) {
                getCustomerFieldOfficer(operationAreaId);
            }

            if (operatorId !== '') {
                $('#operator').val(operatorId).trigger('change');
            }

        };
        const getOperationArea = (operatorId) => {
            const url = "{{ route('operator-operation-areas') }}";
            const operationArea = @json($operation_area_id);
            $.ajax({
                url: url,
                type: 'GET',
                data: {operator_id: operatorId},
                success: function (data) {

                    $('#operation_area').empty();
                    $('#operation_area').append('<option value="">Select Operation Area</option>');
                    $.each(data, function (key, value) {
                        if (operationArea && operationArea.includes(value.id.toString())) {
                            $('#operation_area').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                        } else {
                            $('#operation_area').append('<option value="' + value.id + '">' + value.name + '</option>');
                        }
                    });
                    $('#operation_area').select2();
                }
            });
        };
    </script>
@endsection
