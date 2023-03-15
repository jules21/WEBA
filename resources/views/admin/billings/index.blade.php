@extends('layouts.master')
@section('title', 'Stock')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Billings </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Billings</a>
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
    <div class="container">
        <div class="card">
            <div class="card-content card-custom">
                <div class="card-header pb-1 pt-3">
                    <h3>Billings</h3>
                </div>
                <div class="card-body">
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
                            <div class="col-md-3 form-group">
                                <label for="operation_area">Operation Area</label>
                                <select name="operation_area_id[]" id="operation_area" class="form-control select2"
                                        data-placeholder="Select Operation Area" multiple="multiple">
                                    @foreach($operationAreas  ?? [] as $operationArea)
                                        <option value="{{ $operationArea->id }}">{{ $operationArea->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Customer Field Officer</label>
                                <select name="customer_field_officer_id[]" id="customer_field_officer" class="form-control select2"
                                        data-placeholder="Select Customer Field Officer" multiple="multiple">
                                    @foreach($customerFieldOfficers ?? [] as $customerFieldOfficer)
                                        <option value="{{ $customerFieldOfficer->id }}">{{ $customerFieldOfficer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="items">Meter Number</label>
                                 <input type="text" name="meter_number" id="meter_number" class="form-control" placeholder="Meter Number">
                            </div>
                                <div class="col-md-3 form-group">
                                    <label for="items">Subscription Number</label>
                                    <input type="text" name="subscription_number" id="subscription_number" class="form-control" placeholder="Subscription Number">
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
                    <div class="table-responsive">
                        {{$dataTable->table(['class' => 'table table-bordered table-hover table-checkable dataTable no-footer dtr-inline'], true)}}
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


    </div>
@endsection
@section('scripts')
    {{$dataTable->scripts()}}
    <script>
        $(document).ready(function () {
            initData();
            $("#kt_datatable1").DataTable({responsive:true});
        });
        $(document).on('change', '#operator', function () {
            let operatorId = $(this).val();
            if (operatorId !== '') {
                getOperationArea(operatorId);
            } else {
                $('#operation_area').empty();
                $('#operation_area').append('<option value="">Select Operation Area</option>');
            }
        });
        const getOperationArea = (operatorId) => {
            const url = "{{ route('get-operation-areas') }}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {operator_id: operatorId},
                success: function (data) {

                    $('#operation_area').empty();
                    $('#operation_area').append('<option value="">Select Operation Area</option>');
                    $.each(data[0], function (key, value) {
                        console.log(value)
                        $('#operation_area').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        };
        const initData = () => {
            const operatorId = "{{ request()->get('operator_id') ? implode(',', request()->get('operator_id')) : '' }}";
            const operationAreaId = "{{ request()->get('operation_area_id') ? implode(',', request()->get('operation_area_id')) : '' }}";


            if (operatorId !== '') {
                $('#operator').val(operatorId.split(',')).trigger('change');
                getOperationArea(operatorId.split(','));
            }
            if (operationAreaId !== '') {
                $('#operation_area').val(operationAreaId.split(',')).trigger('change');
            }
        };

        $(document).on('click','.btn-details', function (e){
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
    </script>
@endsection
