@extends('layouts.master')
@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card h-100">
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::User-->
                    <div class="d-flex align-items-center">

                        <div>
                            <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                {{ $user->operator->name }}
                            </a>

                        </div>
                    </div>
                    <!--end::User-->
                    <!--begin::Contact-->
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <span class="font-weight-bold mr-2">Legal Type:</span>
                            <a href="#" class="text-muted text-hover-primary">
                                {{ $user->operator->legalType->name }}
                            </a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <span class="font-weight-bold mr-2">Doc Number:</span>
                            <span class="text-muted">
                                    {{ $user->operator->doc_number }}
                                </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <span class="font-weight-bold mr-2">Province:</span>
                            <span class="text-muted">
                                        {{ $user->operator->province->name }}
                                    </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <span class="font-weight-bold mr-2">District:</span>
                            <span class="text-muted">
                                        {{ $user->operator->district->name??'N/A' }}
                                    </span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <span class="font-weight-bold mr-2">Sector:</span>
                            <span class="text-muted">
                                        {{ $user->operator->sector->name??'N/A' }}
                                    </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-6">
                            <span class="font-weight-bold mr-2">Cell:</span>
                            <span class="text-muted">
                                        {{ $user->operator->cell->name??'N/A' }}
                                    </span>
                        </div>


                    </div>
                    <!--end::Contact-->

                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card h-100">
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" method="POST" id="updateProfileForm" enctype="multipart/form-data"
                      action="{{ route('admin.operator.update',encryptId($user->operator_id)) }}">
                    @csrf
                    @method('PUT')
                    <input type="file" name="logo" id="logo" style="display: none"/>

                    <!--end::Notice-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <h5 class="font-weight-bold mt-10 mb-6">
                                    Profile Info
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-3"></label>
                            <div class="col-lg-9 col-xl-6">
                                <div
                                    class="symbol symbol-60 symbol-xxl-100  mr-5 align-self-start align-self-xxl-center ">
                                    <div class="symbol-label" id="logoPreview"
                                         style="background-image:url({{ $user->operator->logo_url }});background-size: contain"></div>
                                    <button id="btnLogoPicker" type="button"
                                            class="position-absolute right-0 btn-sm  btn btn-light-success rounded-circle top-0 btn-icon-success btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-edit"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right">Address</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-map"></i>
                                            </span>
                                    </div>
                                    <input type="text"
                                           class="form-control form-control-lg "
                                           value="{{ $user->operator->address }}" placeholder="Address" id="address"
                                           name="address"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js') }}"></script>
    {{--    {!! $validator->selector('#updateProfileForm') !!}--}}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateOperatorRequest::class) !!}

    <script>
        $(function () {

            $('#btnLogoPicker').on('click', function () {
                $('#logo').trigger('click');
            });

            $('#logo').on('change', function () {
                let file = $(this)[0].files[0];
                let reader = new FileReader();
                reader.onloadend = function () {
                    $('#logoPreview').css('background-image', 'url("' + reader.result + '")');
                }
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    $('#logoPreview').css('background-image', 'url("")');
                }
            });

        });
    </script>
@endsection
