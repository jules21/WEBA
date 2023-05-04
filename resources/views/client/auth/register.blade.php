@extends('client.layout.guest')
@section('title', 'Register')
@section('content')
    <div class="card tw-shadow bg-transparent tw-mt-20 overflow-hidden tw-rounded-xl border tw-border-primary">
        <div class="row">
            <div class="col-lg-4">
                <div class="text-white card-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                    </div>
                    <h2>Create An Account </h2>
                    <p class="text-1">
                        Welcome to our system! We're excited that you're interested in creating an account with us. <br>
                        By creating an account, you'll be able to access exclusive features and content that are not
                        available to non-registered users.
                        {{--                To get started, please fill out the registration form below.--}}
                    </p>
                    <p class="text-2">
                        If you've already created an account with us, please click the button below to log in.
                    </p>
                    <div class="form-left-last">
                        <a href="{{ route('client.login') }}" class="btn btn-outline-light">Login to your account
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 bg-white">
                <div class="card-body">
                    <form method="post" id="register-client" action="{{ route('client.register') }}">
                        @csrf
                        <h2>Register Form</h2>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required
                                           value="{{ old('name') }}"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" required
                                           value="{{ old('phone') }}"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" id="email" class="form-control" required
                                           value="{{ old('email') }}"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="legal_type_id">Legal Type</label>
                                    <select name="legal_type_id" id="legal_type_id" class="form-control" required>
                                        <option value="">Select Legal</option>
                                        @foreach($legalTypes as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('legal_type_id') == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="document_type_id">Document Type</label>
                                    <select name="document_type_id" id="document_type_id" class="form-control" required>
                                        <option value="">Select Type</option>
                                        @foreach($idTypes as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('document_type_id') == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="doc_number">Document Number</label>
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
                                            Check
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="province_id">Province</label>
                                    <select name="province_id" id="province_id" class="form-control" required>
                                        <option value="">Select Province</option>
                                        @foreach($provinces as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(old('province_id') == $item->id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="">Select District</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sector_id">Sector</label>
                                    <select name="sector_id" id="sector_id" class="form-control" required>
                                        <option value="">Select Sector</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="cell_id">Cell</label>
                                    <select name="cell_id" id="cell_id" class="form-control" required>
                                        <option value="">Select Cell</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="village_id">Village</label>
                                    <select name="village_id" id="village_id" class="form-control">
                                        <option value="">Select Village</option>
                                    </select>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password-confirm"
                                           class="form-control"/>
                                    <span class="invalid-feedback small"></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="register" class="btn btn-primary" >
                                Create Account
                            </button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\RegisterClientRequest::class,'#register-client') !!}

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
        $('#district_id').on('change', function (e) {
            getSectors($(this).val());
        });
        $('#sector_id').on('change', function (e) {
            getCells($(this).val());
        });


        let $docNumber = $('#doc_number');
        let $inputDocNumber = $docNumber;
        let $documentTypeId = $('#document_type_id');
        let $legalTypeId = $('#legal_type_id');


        $(document).on("submit", '#register-client', function () {
            //add spinner to button
            const btn = $('input[type="submit"]');
            btn.attr('disabled', true);
            btn.val('Please wait...');

            btn.addClass('spinner-border spinner-border-sm');

            //remove spinner after 3 seconds
            setTimeout(function () {
                btn.removeClass('spinner-border spinner-border-sm');
                btn.attr('disabled', false);
                btn.val('Register');
            }, 3000);
        });


        $legalTypeId.on('change', function () {
            getDocumentTypes($(this).val());
            $documentTypeId.trigger('change');
        });
    </script>
@endsection


