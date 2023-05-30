        @extends('client.layout.auth')

        @section('title',trans('app.profile'))

        @section('breadcrumbs')
            <x-layouts.breadcrumb page-title="{{__('app.new_request')}}">

                <x-layouts.breadcrumb-item>
                    <a href="" class="text-muted text-decoration-none">
                        @lang('app.user')
                    </a>
                </x-layouts.breadcrumb-item>

                <x-layouts.breadcrumb-item>
                    @lang('app.profile')
                </x-layouts.breadcrumb-item>

            </x-layouts.breadcrumb>
        @endsection


        @section('content')
            <div class="container">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="https://ui-avatars.com/api/?name={{auth('client')->user()->name}}&color=7F9CF5&background=EBF4FF"
                                             alt="Admin" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4>{{auth('client')->user()->name}}</h4>
                                            <p>
                                                <a href="mailto:{{auth('client')->user()->email}}"
                                                   class="text-decoration-none text-muted">{{auth('client')->user()->email}}</a> |
                                            <a href="tel:{{auth('client')->user()->phone}}"
                                                    class="text-decoration-none">{{auth('client')->user()->phone}}</a>
                                            </p>
                                            <p class="text-muted font-size-sm">
                                                {{optional(auth('client')->user()->province)->name}},
                                                {{optional(auth('client')->user()->district)->name}},
                                                {{optional(auth('client')->user()->sector)->name}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="profile-details">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">@lang('app.full_name')</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{auth('client')->user()->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">@lang('app.email')</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{auth('client')->user()->email}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">@lang('app.phone')</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{auth('client')->user()->phone}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">@lang('app.identity')</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{auth('client')->user()->legalType->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">@lang('app.identity_number')</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{auth('client')->user()->documentType->name}}:
                                            {{auth('client')->user()->doc_number}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">@lang('app.address')</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{optional(auth('client')->user()->province)->name}},
                                            {{optional(auth('client')->user()->district)->name}},
                                            {{optional(auth('client')->user()->sector)->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
{{--                                            <a class="btn btn-info " id="edit-profile-btn" href="#">Edit</a>--}}
                                            <a class="btn btn-primary text-white" id="change-password-btn" href="#">@lang('app.change_password')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-none" id="edit-profile">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('client.profile.update', auth('client')->user()->id)}}"
                                          method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">@lang('app.full_name')</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value={{auth('client')->user()->name}}>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">@lang('app.email')</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value={{auth('client')->user()->email}} disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">@lang('app.phone')</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value={{auth('client')->user()->phone}} disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">@lang('app.profile')</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value={{auth('client')->user()->province->name}} disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">@lang('app.district')</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value={{auth('client')->user()->district->name}} disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">@lang('app.sector')</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value={{auth('client')->user()->sector->name}} disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="{{__('app.save_changes')}}">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 d-none" id="change-password">
                            <div class="card">
                                <div class="card-body">
                                    <form class="kt-form kt-form--label-right" id="change-password-form" method="POST" action="{{route("client.update-password")}}">
                                        @csrf
                                        <div class="card-body">
                                            <!--begin::Alert-->
                                            {{-- @include('partials._alerts') --}}
                                            <!--end::Alert-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">@lang('app.current_password')</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="current_password" placeholder="{{__('app.current_password')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">@lang('app.new_password')</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="new_password" placeholder="{{__('app.new_password')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">@lang('app.verify_password')</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="password" class="form-control form-control-lg form-control-solid" name="new_confirm_password" placeholder="{{__('app.verify_password')}}">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="submit" class="btn btn-success mr-2">@lang('app.change_password')</button>
                                                    <button type="reset" class="btn btn-secondary">@lang('app.clear')</button>
                                                </div>
                                                <div>
                                                <button type="button" class="btn btn-danger" id="cancel-password-btn">@lang('app.cancel')</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @section('scripts')
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
                <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
                {!! JsValidator::formRequest('App\Http\Requests\ChangeClientPasswordRequest','#change-password-form') !!}
            <script>
                $(document).ready(function () {
                    $('#edit-profile-btn').click(function () {
                        $('#profile-details').addClass('d-none');
                        $('#edit-profile').removeClass('d-none');
                    })

                    $(document).on('click', '#change-password-btn', function () {
                        $('#profile-details').addClass('d-none');
                        $('#edit-profile').addClass('d-none');
                        $('#change-password').removeClass('d-none');
                    });

                    $(document).on('click', '#cancel-password-btn', function () {
                        $('#profile-details').removeClass('d-none');
                        $('#edit-profile').addClass('d-none');
                        $('#change-password').addClass('d-none');
                    });
                })

            </script>
        @endsection
