@extends('layouts.master')

@section('title',(isset($request)?'Edit':'New'). " Request")

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

    <div class="card shadow-none border">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    {{ isset($request)?'Edit':'New' }} Request
                </h4>
            </div>

            <form
                action="{{ isset($request)?route('admin.requests.update',encryptId($request->id)): route("admin.requests.store") }}"
                class="mt-4" method="post" id="formSave"
                enctype="multipart/form-data">
                @csrf
                @method(isset($request)?'PUT':'POST')
                <input type="hidden" value="{{ $request->id??0 }}" name="id">
                <input type="hidden" value="{{ \App\Models\RequestType::NEW_CONNECTION }}" name="request_type_id">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="customer_id">Customer</label>
                            <select name="customer_id" id="customer_id" class="form-control select2"
                                    style="width:100% !important;">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option
                                        {{ isset($request) && $request->customer_id == $customer->id ? 'selected' : (request()->has('c_id')&& decryptId(request('c_id'))==$customer->id?'selected':'') }}
                                        value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @can(\App\Constants\Permission::ManageCustomers)
                            <div class="alert alert-light-info alert-custom mb-0 py-2 px-3">
                                <div class="alert-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-info-circle"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 9h.01"></path>
                                        <path d="M11 12h1v4h1"></path>
                                    </svg>
                                </div>
                                <div class="alert-text text-dark">
                                    Can't find a customer in the list?
                                    <a href="{{ route('admin.customers.index',['add'=>'new']) }}"
                                       class="btn btn-sm btn-link font-weight-bolder">
                                        Go to customers
                                    </a>
                                </div>
                            </div>
                        @elsecannot(\App\Constants\Permission::ManageCustomers)
                            <div class="alert alert-light-warning alert-custom mb-0 py-2 px-3">
                                <div class="alert-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-exclamation-circle" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                        <path d="M12 9v4"></path>
                                        <path d="M12 16v.01"></path>
                                    </svg>
                                </div>
                                <div class="alert-text text-dark">
                                    If you can't find a customer in the list, please contact the admin.
                                </div>
                            </div>
                        @endcan

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
                                    <option
                                        {{ isset($request) && $request->water_usage_id == $requestType->id ? 'selected' : '' }}
                                        value="{{ $requestType->id }}">{{ $requestType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="meter_qty">
                                How many meters do you need?
                            </label>
                            <input type="number"
                                   value="{{ isset($request)?$request->meter_qty:"" }}"
                                   name="meter_qty" id="meter_qty" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="upi">UPI</label>
                            <input type="text"
                                   value="{{ isset($request)?$request->upi:"" }}"
                                   name="upi" id="upi" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="upi_attachment">UPI Attachment </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upi_attachment"
                                       name="upi_attachment">
                                <label class="custom-file-label" for="upi_attachment">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="sector_id">Sector </label>
                            <select name="sector_id" id="sector_id" class="form-control select2"
                                    style="width:100% !important;">
                                <option value="">Select Sector</option>
                                @foreach($sectors as $item)
                                    <option
                                        {{ isset($request) && $request->sector_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="cell_id">Cell </label>
                            <select name="cell_id" id="cell_id" class="form-control select2"
                                    style="width:100% !important;">
                                <option value="">Select Cell</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="village_id">Village </label>
                            <select name="village_id" id="village_id" class="form-control select2"
                                    style="width:100% !important;">
                                <option value="">Select Village</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control">{{ isset($request)?$request->description:'' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="cross_road">New connection will cross the road</label>
                        <div class="form-group">
                            <label class="radio checkbox-accent">
                                <input type="radio" value="1"
                                       {{ isset($request) && $request->new_connection_crosses_road == 1 ? 'checked' : '' }}
                                       name="new_connection_crosses_road">
                                <span class="mr-1 "></span>
                                Yes
                            </label>
                            <label class="radio checkbox-accent">
                                <input type="radio"
                                       {{ isset($request) && $request->new_connection_crosses_road == 0 ? 'checked' : '' }}
                                       value="0" name="new_connection_crosses_road">
                                <span class="mr-1 "></span>
                                No
                            </label>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="roadTypeContainer" style="display: none">
                            <label for="road_type">Road Type</label>
                            <select name="road_type" id="road_type" class="form-control ">
                                <option value="">Select Road Type</option>
                                @foreach($roadTypes as $roadType)
                                    <option
                                        {{ isset($request) && $request->road_type == $roadType ? 'selected' : '' }}
                                        value="{{ $roadType }}">{{ $roadType }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="road_cross_types">
                                Where will the water pipe cross ?
                            </label>
                            <div class="row">
                                @foreach($roadCrossTypes as $item)
                                    <div class="col-md-4">
                                        <label class="checkbox my-3 checkbox-primary">
                                            <input type="checkbox" value="{{ $item->id }}"
                                                   {{ isset($request) && in_array($item->id, $selected_road_cross_types??[]) ? 'checked' : '' }}
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
                                <input type="radio"
                                       {{ isset($request) && $request->digging_pipeline == 1 ? 'checked' : '' }}
                                       value="1" name="digging_pipeline">
                                <span class="mr-1 "></span>
                                Yes
                            </label>
                            <label class="radio checkbox-primary">
                                <input type="radio"
                                       {{ isset($request) && $request->digging_pipeline == 0 ? 'checked' : '' }}
                                       value="0" name="digging_pipeline">
                                <span class="mr-1 "></span>
                                No
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>
                            Do You want to pay for the materials yourself by submitting an EBM invoice ?
                        </label>
                        <div class="form-group">
                            <label class="radio  checkbox-primary">
                                <input type="radio"
                                       {{ isset($request) && $request->equipment_payment == 1 ? 'checked' : '' }}
                                       value="1" name="equipment_payment">
                                <span class="mr-1 "></span>
                                Yes
                            </label>
                            <label class="radio checkbox-primary">
                                <input type="radio"
                                       {{ isset($request) && $request->equipment_payment == 0 ? 'checked' : '' }}
                                       value="0" name="equipment_payment">
                                <span class="mr-1 "></span>
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">
                            <span class="svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor"
                                 class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                            </span>
                        {{ isset($request)?'Update':'Submit' }}
                        Request
                    </button>
                </div>
            </form>
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
            $('.nav-request-management').addClass('menu-item-active menu-item-open');
            $('.nav-create-request').addClass('menu-item-active');

            $('#province_id').on('change', function (e) {
                getDistricts($(this).val());
            });


            $('#district_id').on('change', function (e) {
                getSectors($(this).val());
            });


            $('#sector_id').on('change', function (e) {
                getCells($(this).val());
            });

            @if(isset($request))
            getCells({{ $request->sector_id }}, {{ $request->cell_id }});
            @endif

            // radio with name new_connection_crosses_road
            $('input[name="new_connection_crosses_road"]').on('change', function (e) {
                if ($(this).val() === '1') {
                    $('#roadTypeContainer').slideDown();
                } else {
                    $('#roadTypeContainer').slideUp();
                }
            });

            $('#formSave').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);
                if (!$form.valid())
                    return;
                let $btn = $form.find(":submit");

                $btn.prop("disabled", true)
                    .addClass("spinner spinner-white spinner-sm spinner-right");

                e.target.submit();

            });

        });
    </script>
@endsection
