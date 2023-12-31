@extends('client.layout.auth')

@section('title',"New Request")

@section('breadcrumbs')
    <x-layouts.breadcrumb page-title="New Request">

        <x-layouts.breadcrumb-item>
            <a href="" class="text-muted text-decoration-none">
                {{__('app.request')}}
            </a>
        </x-layouts.breadcrumb-item>

        <x-layouts.breadcrumb-item>
            {{__('app._new_connection')}}
        </x-layouts.breadcrumb-item>

    </x-layouts.breadcrumb>
@endsection
@section('content')
    <div class="card card-body h-100 tw-rounded-md">
        <h4>
            {{ isset($request)?'Edit':trans('app.request') }} @lang('app._new_connection')
        </h4>
        <div class="tw-text-sm alert alert-info d-flex align-items-center tw-gap-2">
            <i class="ti ti-info-circle tw-text-[24px]"></i> @lang('app.fill_the_form_below_to_request_new_connection')
        </div>

        <form
            action="{{ $action }}"
            class="mt-2" method="post" id="formSave"
            enctype="multipart/form-data">
            @csrf
            @method(isset($request)?'PUT':'POST')
            <input type="hidden" value="{{ $request->id??0 }}" name="id">
            <input type="hidden" value="{{ \App\Models\RequestType::NEW_CONNECTION }}" name="request_type_id">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="water_usage_id">
                            @lang('app.water_usage')
                            <x-required-sign/>
                        </label>
                        <select name="water_usage_id" id="water_usage_id" class="form-control select2" required
                                style="width:100% !important;">
                            <option value="">@lang('app.please_select')</option>
                            @foreach($waterUsage as $requestType)
                                <option
                                    {{ old('water_usage_id',$request->water_usage_id??'') == $requestType->id ? 'selected' : '' }}
                                    value="{{ $requestType->id }}">
                                    {{ $requestType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="meter_qty">
                            @lang('app.how_many_meters_do_you_need?')
                            <x-required-sign/>
                        </label>
                        <input type="number" required
                               value="{{ old('meter_qty',$request->meter_qty??"") }}" min="1"
                               name="meter_qty" id="meter_qty" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="upi">UPI
                            <x-required-sign/>
                        </label>
                        <input type="text" value="{{old('upi',$request->upi??"") }}"
                               required
                               name="upi" id="upi" class="form-control"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="upi_attachment">@lang('app.UPI_attachment')
                            <x-required-sign/>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="upi_attachment"
                                   {{ isset($request)?'':'required'  }}
                                   accept=".pdf,image/jpeg,image/png,image/jpg"
                                   name="upi_attachment">
                            <label class="custom-file-label tw-truncate"
                                   for="upi_attachment">@lang('app.choose_file')</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="province_id">@lang('app.province')
                            <x-required-sign/>
                        </label>
                        <select name="province_id" id="province_id" class="form-control select2" required
                                style="width:100% !important;">
                            <option value="">@lang('app.select_province')</option>
                            @foreach($provinces ?? [] as $item)
                                <option
                                    {{ isset($request) && $request->province_id == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="district_id">@lang('app.district')
                            <x-required-sign/>
                        </label>
                        <select name="district_id" id="district_id" class="form-control select2" required
                                style="width:100% !important;">
                            <option value="">@lang('app.select_district')</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="sector_id">@lang('app.sector')
                            <x-required-sign/>
                        </label>
                        <select name="sector_id" id="sector_id" class="form-control select2" required
                                style="width:100% !important;">
                            <option value="">@lang('app.select_sector')</option>
                            @foreach($sectors ?? [] as $item)
                                <option
                                    {{ isset($request) && $request->sector_id == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="cell_id">@lang('app.cell')
                            <x-required-sign/>
                        </label>
                        <select name="cell_id" id="cell_id" class="form-control select2" required
                                style="width:100% !important;">
                            <option value="">@lang('app.select_cell')</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="village_id">@lang('app.village')
                            <x-required-sign/>
                        </label>
                        <select name="village_id" id="village_id" class="form-control select2"
                                style="width:100% !important;">
                            <option value="">@lang('app.select_village')</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="description">@lang('app.description')</label>
                        <textarea name="description" id="description" rows="3"
                                  class="form-control">{{ isset($request)?$request->description:'' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <label>@lang('app.will_you_dig_a_water_pipe_by_yourself_?')
                        <x-required-sign/>
                    </label>
                    <div class="form-group">
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input
                                    {{ isset($request) && $request->digging_pipeline == 1 ? 'checked' : '' }} type="radio"
                                    required
                                    id="customRadioInline1" value="1" name="digging_pipeline"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">
                                    @lang('app.yes')
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input
                                    {{ isset($request) && $request->digging_pipeline == 0 ? 'checked' : '' }} type="radio"
                                    required
                                    id="customRadioInline2" value="0" name="digging_pipeline"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">@lang('app.no')</label>
                            </div>
                        </div>
                        <label id="digging_pipeline-error" class="error" for="digging_pipeline"></label>
                    </div>

                </div>


            </div>

            <div class=" mb-4" style="border-bottom: 3px dotted #95989d">

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="terms_conditions" required class="custom-control-input"
                           id="terms_conditions">
                    <label class="custom-control-label" for="terms_conditions">
                        I agree to the <a
                            href="https://www.termsandconditionsgenerator.com/live.php?token=zSDhmGUj0e9MmCND6uhUNUs5Oxb3Sbct"
                            target="_blank">terms and conditions
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                            </svg>
                        </a>
                    </label>
                </div>
                <label id="terms_conditions-error" class="error" for="terms_conditions" style=""></label>

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M9 12l2 2l4 -4"></path>
                    </svg>
                    {{ isset($request)?($request->return_back_status==\App\Constants\Status::RETURN_BACK?'Re-Submit':'Update'):trans('app.submit') }}
                    @lang('app.request')
                </button>
            </div>
        </form>

    </div>
@endsection
@section('scripts')
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
            let $formSave = $('#formSave');
            // validate form's terms and conditions
            $formSave.validate({
                rules: {
                    terms_conditions: {
                        required: true
                    }
                },
                messages: {
                    terms_conditions: {
                        required: "Please accept our terms and conditions"
                    }
                }
            })
            $formSave.on('submit', function (e) {
                e.preventDefault();
                if ($(this).valid()) {
                    let btn = $(this).find('button[type=submit]');
                    btn.prop('disabled', true);
                    btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                    e.target.submit();
                }
            });

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
            let newConnectionCrossesRoad = $('input[name="new_connection_crosses_road"]');
            newConnectionCrossesRoad.on('change', function (e) {
                console.log($(this).val());
                if (Number($(this).val()) === 1) {
                    $('#roadTypeContainer').css('display', 'block');
                } else {
                    $('#roadTypeContainer').css('display', 'none');
                }
            });

        });
    </script>
@endsection
