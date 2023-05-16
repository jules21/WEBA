@extends('layouts.master')

@section('title',"All Requests")

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none " id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    {{ isset($customer)?$customer->name."'s":'All' }} Requests
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
                        <span class="text-muted">Request Management</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

        </div>
    </div>

    <!--begin:filter-->
    <div class="card card-body mb-4">
        @if(Str::contains(Route::currentRouteName(), 'admin.requests.index'))
            <form action="#" id="filter-form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                            <label for="from_date">From Date</label>
                            <input type="date" name="start_date" id="from_date" class="form-control " placeholder="From Date" value="{{request()->get('start_date')}}">
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="to_date">To Date</label>
                        <input type="date" name="end_date" id="to_date" class="form-control" placeholder="To Date" value="{{request()->get('end_date')}}">
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
{{--                    //Add more filters here--}}
{{--                    filter by UPI--}}
                    <div class="col-md-3 form-group">
                        <label for="upi">UPI</label>
                        <input type="text" name="upi" id="upi" class="form-control" placeholder="UPI number" value="{{request()->get('upi')}}">
                    </div>
{{--                    filter by request type--}}
                    <div class="col-md-3 form-group">
                        <label for="request_type">Request Type</label>
                        <select name="request_type" id="request_type" class="form-control select2"
                                data-placeholder="Select Request Type">
                            <option value="">Select Request Type</option>
                            @foreach($requestTypes ?? [] as $requestType)
                                <option value="{{ $requestType->id }}" {{request()->get('request_type') == $requestType->id ? 'selected' : ''}}>{{ $requestType->name }}</option>
                            @endforeach
                        </select>
                    </div>
{{--                    filter by request status--}}
                    <div class="col-md-3 form-group">
                        <label for="request_status">Request Status</label>
                        <select name="request_status" id="request_status" class="form-control select2"
                                data-placeholder="Select Request Status">
                            <option value="">Select Request Status</option>
                            @foreach($requestStatuses ?? [] as $requestStatus)
                                <option value="{{ $requestStatus }}" {{request()->get('request_status') == $requestStatus ? 'selected' : ''}}>{{ $requestStatus }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group align-self-end">
                        <div class="row col-12">
                            <button type="submit" class="btn btn-primary mr-2" id="submit-btn">
                                <i class="la la-search"></i>
                                Filter
                            </button>
                            <a href="{{route('admin.requests.index')}}" class="btn btn-outline-dark"> clear search</a>
                        </div>
                    </div>

                </div>
            </form>
        @endif
    </div>
    <!--end:filter-->

    <div class="card tw-shadow-sm border tw-border-gray-300">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                <h4>
                    {{ isset($customer)?$customer->name."'s":'All' }} Requests
                </h4>
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


            <div class="table-responsive my-3">
                <table class="table table-head-custom border rounded-lg table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Customer</th>
                        <th>Request Type</th>
                        <th>Meter Qty</th>
                        <th>UPI</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @php
        //Declare new queries you want to append to string:
        $newQueries = ['is_download' => 1];
        $newUrl = request()->fullUrlWithQuery($newQueries);
    @endphp
@endsection

@section('scripts')
    {{--  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
      {!! JsValidator::formRequest(App\Http\Requests\StoreCustomerRequest::class) !!}--}}

    <script>
        const initData = () => {
            const operatorId = "{{ request()->get('operator_id') ? request()->get('operator_id') : '' }}";
            if (operatorId !== '') {
                getOperationArea(operatorId);
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

        $(document).ready(function () {
            initData();
            $('.nav-request-management').addClass('menu-item-active menu-item-open');
            $('.nav-all-requests').addClass('menu-item-active');

            window.dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {
                        data: "created_at", name: "created_at",
                        render: function (data, type, row) {
                            return (new Date(data)).toLocaleDateString();
                        }
                    },
                    {data: "customer.name", name: "customer.name"},
                    {data: "request_type.name", name: "requestType.name"},
                    {data: "meter_qty", name: "meter_qty"},
                    {data: "upi", name: "upi"},
                    {
                        data: "status", name: "status",
                        render: function (data, type, row) {
                            return `<span class="badge badge-${row.status_color} rounded-pill">${data}</span>`;
                        },
                    },
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
            });

            $('#addButton').on('click', function () {
                $('#addModal').modal('show');
            });

            $(document).on('click', '.js-delete', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                dataTable.ajax.reload();
                            }
                        })
                    }
                });

            });

            $(document).on("click","#excel", function(e) {
                let url = "{!! $newUrl !!}";
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

        });


    </script>

@endsection
