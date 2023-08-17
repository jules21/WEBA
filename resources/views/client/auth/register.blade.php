@extends('client.layout.guest')
@section('title', trans('auth.register'))
@section('content')
    <div class=" bg-transparent tw-mt-20 overflow-hidden">
        <div class="row">
            <div class="col-lg-4">
                <div class="text-white">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                    </div>
                    <h2>@lang('auth.create_an_account')</h2>
                    <p class="text-1">
                        @lang('auth.welcome_to_our_system_we_excited_that_you_interested_in_creating_an_account_with_us.')
                        <br>
                        <br>
                        @lang('auth.by_creating_an_account')
                        {{--                To get started, please fill out the registration form below.--}}
                    </p>
                    <p class="text-2">
                        @lang('auth.if_you_already_created_an_account_with_us_please_click_the_button_below_to_log_in.')
                    </p>
                    <div class="form-left-last mb-4">
                        <a href="{{ route('welcome') }}"
                           class="btn btn-outline-light">@lang('auth.login_to_your_account')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-body card tw-rounded-md">
                    <form method="post" id="register-client" action="{{ route('client.register') }}">
                        @csrf
                        <h2>@lang('auth.register_form')</h2>
                        <div class="row">

                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="legal_type_id">@lang('auth.legal_type')</label>
                                    <select name="legal_type_id" id="legal_type_id" class="form-control" required>
                                        <option value="">@lang('auth.select_type')</option>
                                        @foreach($legalTypes as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('legal_type_id') == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="document_type_id">@lang('auth.document_type')</label>
                                    <select name="document_type_id" id="document_type_id" class="form-control" required>
                                        <option value="">@lang('auth.select_type')</option>
                                        @foreach($idTypes as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('document_type_id') == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="doc_number">@lang('auth.document_number')</label>
                                    <div class="d-flex flex-shrink-0">
                                        <div class="w-100">
                                            <input type="text" id="doc_number" name="doc_number"
                                                   value="{{ old('doc_number') }}"
                                                   class="form-control"
                                                   required/>
                                            <span class="invalid-feedback small"></span>
                                        </div>
                                        <button type="button" id="btnCheckIdDetails" style="display: none"
                                                class="btn btn-primary ml-2 align-self-start">
                                            @lang('auth.check')
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="name">@lang('auth.name')</label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                           value="{{ old('name') }}"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="phone">@lang('auth.phone_number')</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" required
                                           value="{{ old('phone') }}"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="email">@lang('auth.email_address.')</label>
                                    <input type="email" name="email" id="email" class="form-control" required
                                           value="{{ old('email') }}"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="province_id">@lang('auth.province')</label>
                                    <select name="province_id" id="province_id" class="form-control" required>
                                        <option value="">@lang('auth.select_province')</option>
                                        @foreach($provinces as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('province_id') == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="district_id">@lang('auth.district')</label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="">@lang('auth.select_district')</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="sector_id">@lang('auth.sector')</label>
                                    <select name="sector_id" id="sector_id" class="form-control" required>
                                        <option value="">@lang('auth.select_sector')</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="cell_id">@lang('auth.cell')</label>
                                    <select name="cell_id" id="cell_id" class="form-control" required>
                                        <option value="">@lang('auth.select_cell')</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="village_id">@lang('auth.village')</label>
                                    <select name="village_id" id="village_id" class="form-control">
                                        <option value="">@lang('auth.Select_village')</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">@lang('auth.password')</label>
                                    <input type="password" name="password" id="password" class="form-control" required/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm">@lang('auth.confirm_password')</label>
                                    <input type="password" name="password_confirmation" id="password-confirm"
                                           class="form-control"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="register" class="btn btn-primary">
                                @lang('auth.create_account')
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\RegisterClientRequest::class,'#register-client') !!}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        let $districtId = $('#district_id');

        function getDistricts(provinceId, selectedDistrictId) {
            let districtId = $districtId;
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

        let $sectorId = $('#sector_id');

        function getSectors(districtId, selectedSectorId) {
            let sectorId = $sectorId;
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
                    $.each(data, function (index, value) {
                        villageId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    villageId.val(selectedVillageId);
                }
            })
        }

        function getDocumentTypes(legalTypeId, selectedDocTypedId) {
            let docTypeId = $('#document_type_id');
            docTypeId.empty();
            docTypeId.append('<option value="">Select Doc Type</option>');
            $.ajax({
                url: "/documents-types/" + legalTypeId,
                method: "GET",
                success: function (data) {
                    $.each(data, function (index, value) {
                        docTypeId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    docTypeId.val(selectedDocTypedId);
                }
            })


        }


        $('#province_id').on('change', function (e) {
            getDistricts($(this).val());
        });
        $districtId.on('change', function (e) {
            getSectors($(this).val());
        });
        $sectorId.on('change', function (e) {
            getCells($(this).val());
        });


        let $docNumber = $('#doc_number');
        let $inputDocNumber = $docNumber;
        let $documentTypeId = $('#document_type_id');
        let $legalTypeId = $('#legal_type_id');
        let globalDocNumber = '';

        let $form = $('#register-client');
        $form.on("submit", function (e) {
            e.preventDefault();
            if (!$form.valid()) {
                return false;
            }
            //add spinner to button
            let btn = $form.find('button[type="submit"]');
            btn.attr('disabled', true);
            btn.val('Please wait...');
            $form.find('input, select, textarea').prop('disabled', false);
            e.target.submit();
        });


        $legalTypeId.on('change', function () {
            getDocumentTypes($(this).val());
            $documentTypeId.trigger('change');
        });

        let $btnCheckIdDetails = $('#btnCheckIdDetails');
        let $name = $('#name');
        {{--$documentTypeId.on('change', function () {--}}
        {{--    let docTypeId = $(this).val();--}}
        {{--    $name.val("");--}}
        {{--    if (docTypeId === "{{ config('app.NATIONAL_ID') }}") {--}}
        {{--        $inputDocNumber.attr('maxlength', '16');--}}
        {{--        $name.attr('disabled', true);--}}
        {{--        $btnCheckIdDetails.show();--}}
        {{--    } else {--}}
        {{--        $inputDocNumber.attr('maxlength', '21');--}}
        {{--        $name.attr('disabled', false);--}}
        {{--        $btnCheckIdDetails.hide();--}}
        {{--    }--}}
        {{--});--}}

        $docNumber.on('keyup', function () {
            if (globalDocNumber !== $(this).val()) {
                $('#name').val("");
            }
            if ($documentTypeId.val() === "{{ config('app.NATIONAL_ID') }}") {
                if ($(this).val().length === 16) {
                    $btnCheckIdDetails.trigger('click');
                }
            }
        });

        $btnCheckIdDetails.on('click', function () {
            let docNumber = $inputDocNumber.val();
            let legalTypeId = $legalTypeId.val();
            let documentTypeId = $documentTypeId.val();
            if (docNumber && legalTypeId && documentTypeId) {
                let url = "{{ route("fetch-identification-from-nida") }}?id=" + docNumber + "&id_type=" + documentTypeId;
                $inputDocNumber.attr('disabled', true);
                $legalTypeId.attr('disabled', true);
                $documentTypeId.attr('disabled', true);

                globalDocNumber = docNumber;

                let btn = $(this);
                btn.attr('disabled', true);
                btn.html(`<div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                        </div>`);

                $.ajax({
                    url: url,
                    method: "get",
                    dataType: 'json',
                    success: function (response) {
                        if (response.documentNumber) {
                            let surnames = response.surnames;
                            let foreName = response.foreName;
                            if (surnames || foreName) {
                                $name.val((surnames ? surnames + " " : '') + (foreName ? foreName : ''));
                            }
                        } else if (response.content && response.status) {
                            Swal.fire({
                                title: 'Error',
                                text: response.content,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: "Something went wrong, please try again later",
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }, error: function (response) {
                        Swal.fire({
                            title: "Error",
                            icon: "error",
                            text: "Unable to check id details, try again"
                        });
                    },
                    complete: function () {
                        btn.attr('disabled', false);
                        btn.html('Check');
                        $inputDocNumber.prop("disabled", false);
                        $legalTypeId.prop("disabled", false);
                        $documentTypeId.prop("disabled", false);
                    }
                });
            }

        });

    </script>
@endsection


