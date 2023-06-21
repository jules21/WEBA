@extends('layouts.master')
@section('title', 'Billing')
@section("css")
    <style>
        .select2-container--default .select2-selection--multiple:before {
            content: ' ';
            display: block;
            position: absolute;
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            right: 6px;
            margin-left: -4px;
            margin-top: -2px;
            top: 50%;
            width: 0;
            cursor: pointer
        }

        .select2-container--open .select2-selection--multiple:before {
            content: ' ';
            display: block;
            position: absolute;
            border-color: transparent transparent #888 transparent;
            border-width: 0 4px 5px 4px;
            height: 0;
            right: 6px;
            margin-left: -4px;
            margin-top: -2px;
            top: 50%;
            width: 0;
            cursor: pointer
        }
    </style>
@endsection
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Billing </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Billing</a>
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
    <div class="card card-body">
        @if(Str::contains(Route::currentRouteName(), 'admin.billings.index'))
            <form action="#" id="filter-form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="from_date">From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control "
                                   placeholder="From Date" value="{{request()->get('from_date')}}">
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="to_date">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                               value="{{request()->get('to_date')}}">
                    </div>
                    @unless(Helper::isOperator())
                        <div class="col-md-3 form-group">
                            <label for="operator">Operator</label>
                            <select name="operator_id" id="operator" class="form-control select2"
                                    data-placeholder="Select Operator">
                                <option value="">Select Operator</option>
                                @foreach($operators ?? [] as $operator)
                                    <option
                                        value="{{ $operator->id }}" {{request()->get('operator_id') == $operator->id ? 'selected' : ''}}>{{ $operator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endunless
                    @unless(Helper::hasOperationArea())
                        <div class="col-md-3 form-group">
                            <label for="operation_area">District</label>
                            <select name="operation_area_id[]" id="operation_area" class="form-control select2"
                                    data-placeholder="Select District" multiple="multiple">
                                @foreach($operationAreas  ?? [] as $operationArea)
                                    <option value="{{ $operationArea->id }}">{{ $operationArea->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endunless
                    @if(Helper::isOperator())
                        <div class="col-md-3 form-group">
                            <label for="customer_field_officer">Customer Field Officer</label>
                            <select name="customer_field_officer_id[]" id="customer_field_officer"
                                    class="form-control select2"
                                    data-placeholder="Select Customer Field Officer" multiple="multiple">
                                @foreach($customerFieldOfficers ?? [] as $customerFieldOfficer)
                                    <option value="{{ $customerFieldOfficer->id }}"
                                        {{request()->get('customer_field_officer_id') == $customerFieldOfficer->id ? 'selected' : ''}}
                                    >{{ $customerFieldOfficer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-md-3 form-group">
                        <label for="meter_number">Meter Number</label>
                        <input type="text" name="meter_number" id="meter_number" class="form-control"
                               placeholder="Meter Number" value="{{request()->get('meter_number')}}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="subscription_number">Subscription Number</label>
                        <input type="text" name="subscription_number" id="subscription_number" class="form-control"
                               placeholder="Subscription Number" value="{{request()->get('subscription_number')}}">
                    </div>
                    <div class="col-md-6 form-group align-self-end">
                        <div class="row col-12">
                            <button type="submit" class="btn btn-primary mr-2" id="submit-btn">
                                <i class="la la-search"></i>
                                Filter
                            </button>
                            <a href="{{route('admin.billings.index')}}" class="btn btn-outline-dark"> clear search</a>
                        </div>
                    </div>

                </div>
            </form>
        @endif
    </div>

    <nav class="my-4 d-flex flex-row-reverse nav" id="nav-tab">
        <button class="btn btn-sm btn-primary active mr-2" data-toggle="tab" id="nav-summary-tab" data-target="#nav-summary">Summary
        </button>
        <button class="btn btn-sm btn-success  mr-2" data-toggle="tab" id="nav-billings-tab" data-target="#nav-billings" type="button"
                role="tab" aria-controls="nav-billings" aria-selected="false">Billings
        </button>
    </nav>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="nav-billings">
            <div class="card shadow-none border">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-5">
                        <h3 class="mb-3">
                            @if(Str::contains(Route::currentRouteName(), 'admin.billings.customer'))
                                {{ $customer->name ?? '' }}
                            @else
                                Customers
                            @endif
                            Billing</h3>
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            {{--                            @if ($requests->count() > 0)--}}
                            <button type="button"
                                    class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i>Export
                            </button>
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
                    <div class="table-responsive">
                        {{$dataTable->table(['class' => 'table table-head-custom border table-head-solid table-hover'])}}
                    </div>

                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="nav-summary">
            <div class="card card-body">
                <h2>Billings Summary</h2>
                <div class="row">
                    <div class="d-flex flex-wrap">
                        <!--begin::Col-->
                        <div class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                    <span class="fs-1 fw-bold text-gray-800 lh-1">
                        <span data-kt-countup="true" data-kt-countup-value="6,840" data-kt-countup-prefix="$" class="counted" data-kt-initialized="1">$6,840</span>
                        <i class="ki-duotone ki-arrow-up fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>                    </span>
                            <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2">Net Earnings</span>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="border border-dashed border-gray-300 w-125px rounded my-3 p-4 me-6">
                    <span class="fs-1 fw-bold text-gray-800 lh-1">
                        <span class="counted" data-kt-countup="true" data-kt-countup-value="16" data-kt-initialized="1">16</span>%
                        <i class="ki-duotone ki-arrow-down fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>                    </span>
                            <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2">Change</span>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                    <span class="fs-1 fw-bold text-gray-800 lh-1">
                        <span data-kt-countup="true" data-kt-countup-value="1,240" data-kt-countup-prefix="$" class="counted" data-kt-initialized="1">$1,240</span>
                        <span class="text-primary">--</span>
                    </span>
                            <span class="fs-6 fw-semibold text-muted d-block lh-1 pt-2">Fees</span>
                        </div>
                        <!--end::Col-->
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-4">
                        <span class="text-dark font-weight-bolder">Total Billed</span> : {{ number_format($totalAmount,2) ?? 0 }} Rwf
                        <br>
                        <span class="text-dark font-weight-bolder">Total Payments</span> : {{ number_format(($totalAmount-$totalBalance),2) ?? 0 }} Rwf
                        <br>
                        <span class="text-dark font-weight-bolder">Remaining Balance to be paid
                        </span> : {{ number_format($totalBalance,2) ?? 0 }} Rwf

                    </div>
                    <div class="col-md-8">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-dialog modal-lg modal-content">
            <div id="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        $(document).ready(function () {
            $('.nav-billings').addClass('menu-item-active');
            initData();
            $("#kt_datatable1").DataTable({responsive: true});
            $(document).on('click', '.btn-details', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        $('#modal-body').html(data);
                        $('#modal').modal('show');
                    }
                });
            })
            $(document).on('change', '#operator', function (e) {
                e.preventDefault();
                let operatorId = $(this).val();
                if (operatorId !== '') {
                    getOperationArea(operatorId);
                } else {
                    $('#operation_area').empty();
                    $('#operation_area').append('<option value="">Select District</option>');
                }
            });
            $(document).on('change', '#operation_area', function (e) {
                e.preventDefault();
                let operationAreaId = $(this).val();
                if (operationAreaId !== '') {
                    getCustomerFieldOfficer(operationAreaId);
                } else {
                    $('#customer_field_officer').empty();
                    $('#customer_field_officer').append('<option value="">Select Customer Field Officer</option>');
                }
            });
            $(document).on("click", "#excel", function (e) {
                let url = "{!! $newUrl !!}";
                $(this).attr("href", url);
            });

            let objToday = new Date(),
                curDay = String(objToday.getDate()).padStart(2, '0'),
                curMonth = String(objToday.getMonth() + 1).padStart(2, '0'),
                curYear = objToday.getFullYear(),

                curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),
                curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes();

            const today = curYear + "/" + curMonth + "/" + curDay + " " + curHour + ":" + curMinute;

            $('.datepicker').datepicker({
                todayHighlight: true,
                autoclose: true,
                // pickerPosition: 'bottom-left',
                todayBtn: true,
                // format: 'yyyy/mm/dd hh:ii',
                endDate: today
            });
            //
        });
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
                    $('#operation_area').append('<option value="">Select District</option>');
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

        const getCustomerFieldOfficer = (operatorAreaId) => {
            const url = "{{ route('get-operation-area-officers') }}";
            const customerFieldOfficer = @json($customer_field_officer_id);
            $.ajax({
                url: url,
                type: 'GET',
                data: {operation_area_id: operatorAreaId},
                success: function (data) {

                    $('#customer_field_officer').empty();
                    $('#customer_field_officer').append('<option value="">Select Customer Field Officer</option>');
                    $.each(data, function (key, value) {
                        if (customerFieldOfficer && customerFieldOfficer.includes(value.id.toString())) {
                            console.log(value.id)
                            $('#customer_field_officer').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                        } else {
                            $('#customer_field_officer').append('<option value="' + value.id + '">' + value.name + '</option>');
                        }
                    });
                    $('#customer_field_officer').select2();
                }
            });
        };


    </script>
@endsection
