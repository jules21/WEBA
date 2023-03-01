@extends('layouts.master')

@section('title',"New Request")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Requests
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
                        <a href="{{ route('admin.requests.index') }}" class="text-muted">Requests</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            New Request
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-none border">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4>
                        New Request
                    </h4>
                </div>

                <form action="{{ route("admin.requests.store") }}" class="mt-4" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="request_type_id">
                                    Request Type
                                </label>
                                <select name="request_type_id" id="request_type_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Request Type</option>
                                    @foreach($requestTypes as $requestType)
                                        <option value="{{ $requestType->id }}">{{ $requestType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="water_usage_id">
                                    Water Usage
                                </label>
                                <select name="water_usage_id" id="water_usage_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Request Type</option>
                                    @foreach($waterUsage as $requestType)
                                        <option value="{{ $requestType->id }}">{{ $requestType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="meter_qty">
                                    How many meters do you need?
                                </label>
                                <input type="number" name="meter_qty" id="meter_qty" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="upi">UPI</label>
                                <input type="text" name="upi" id="upi" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="province_id">Province </label>
                                <select name="province_id" id="province_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $requestType)
                                        <option value="{{ $requestType->id }}">{{ $requestType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="district_id">District </label>
                                <select name="district_id" id="district_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select District</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sector_id">Sector </label>
                                <select name="sector_id" id="sector_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Sector</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cell_id">Cell </label>
                                <select name="cell_id" id="cell_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Cell</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="village_id">Village </label>
                                <select name="village_id" id="village_id" class="form-control select2"
                                        style="width:100% !important;">
                                    <option value="">Select Village</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="cross_road">New connection will cross the road</label>
                            <div class="form-group">
                                <label class="radio checkbox-primary">
                                    <input type="radio" value="1" name="new_connection_crosses_road">
                                    <span class="mr-1 "></span>
                                    Yes
                                </label>
                                <label class="radio checkbox-primary">
                                    <input type="radio" value="0" name="new_connection_crosses_road">
                                    <span class="mr-1 "></span>
                                    No
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="road_type">Road Type</label>
                                <select name="road_type" id="road_type" class="form-control ">
                                    <option value="">Select Road Type</option>
                                    @foreach($roadTypes as $roadType)
                                        <option value="{{ $roadType }}">{{ $roadType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="road_cross_types">Road Crosses</label>
                                <div class="row">
                                    @foreach($roadCrossTypes as $item)
                                        <div class="col-md-4">
                                            <label class="checkbox my-3 checkbox-primary">
                                                <input type="checkbox" value="{{ $item->id }}"
                                                       name="road_cross_types[]">
                                                <span class="mr-1 rounded-0"></span>
                                                {{ $item->name }}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Will you dig a water pipe by yourself?</label>
                            <div class="form-group">
                                <label class="radio checkbox-primary">
                                    <input type="radio" value="1" name="digging_pipeline">
                                    <span class="mr-1 "></span>
                                    Yes
                                </label>
                                <label class="radio checkbox-primary">
                                    <input type="radio" value="0" name="digging_pipeline">
                                    <span class="mr-1 "></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>
                                Do You want to pay for the equipment yourself by submitting an EBM invoice ?
                            </label>
                            <div class="form-group">
                                <label class="radio  checkbox-primary">
                                    <input type="radio" value="1" name="equipment_payment">
                                    <span class="mr-1 "></span>
                                    Yes
                                </label>
                                <label class="radio checkbox-primary">
                                    <input type="radio" value="0" name="equipment_payment">
                                    <span class="mr-1 "></span>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span class="svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor"
                                 class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                            </span>
                            Submit Request
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAppRequest::class) !!}

    <script>

        function getDistricts(provinceId, selectedDistrictId) {
            let districtId = $('#district_id');
            districtId.empty();
            districtId.append('<option value="">Select District</option>');

            $.ajax({
                url: "/districts/" + provinceId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        districtId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    districtId.val(selectedDistrictId);
                }
            });
        }


        function getSectors(districtId, selectedSectorId) {
            let sectorId = $('#sector_id');
            sectorId.empty();
            sectorId.append('<option value="">Select Sector</option>');


            $.ajax({
                url: "/sectors/" + districtId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        sectorId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    sectorId.val(selectedSectorId);
                }
            });
        }


        function getCells(sectorId, selectedCellId) {
            let cellId = $('#cell_id');
            cellId.empty();
            cellId.append('<option value="">Select Cell</option>');
            $.ajax({
                url: "/cells/" + sectorId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        cellId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    cellId.val(selectedCellId);
                }
            })
        }

        function getVillages(cellId, selectedVillageId) {
            let villageId = $('#village_id');
            villageId.empty();
            villageId.append('<option value="">Select Village</option>');
            $.ajax({
                url: "/villages/" + cellId,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        villageId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    villageId.val(selectedVillageId);
                }
            })
        }

        $(function () {
            $('#province_id').on('change', function (e) {
                getDistricts($(this).val());
            });


            $('#district_id').on('change', function (e) {
                getSectors($(this).val());
            });


            $('#sector_id').on('change', function (e) {
                getCells($(this).val());
            });

            $('#formSave').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);
                if (!$form.valid())
                    return;
                let $btn = $form.find(":submit");

                $btn.prop("disabled", true)
                    .addClass("spinner spinner-white spinner-sm spinner-right");
                $.ajax({
                    url: $form.attr("action"),
                    method: "post",
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        dataTable.ajax.reload();
                        $('#addModal').modal('hide');
                    }, error: function (response) {
                        Swal.fire({
                            title: "Error",
                            icon: "error",
                            text: "Unable to save customer, try again"
                        });
                    },
                    complete: function () {

                        $btn.prop("disabled", false)
                            .removeClass("spinner spinner-white spinner-sm spinner-right");
                    }
                });

            });

        });
    </script>
@endsection
