<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>@lang('auth.login')</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('assets/logos/logo.svg') }}"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="admin-bg">

<div class="container tw-min-h-screen d-flex flex-column justify-content-center">

    <div class="row  justify-content-center align-items-center ">
        <div class="col-lg-5 col-md-8 col-sm-10">
            <h3 class="text-center py-1 tw-text-accent">
                CMS
                <small class="tw-text-xs font-weight-bold">RWSS</small>
                <span class="text-white">@lang('auth.login')</span>
            </h3>
            <div class="card lg:tw-p-10 border-0 card-body tw-rounded-sm">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                </div>

                <form action="{{ route('login') }}" autocomplete="off"
                      method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email"
                               class="form-label tw-text-[14px] text-dark tw-opacity-60 tw-leading-[21px] font-weight-normal">
                            @lang('auth.email_address')
                        </label>
                        <input
                            class="form-control tw-py-6 tw-rounded-sm tw-border-[#AAAAAA]  tw-text-[14px] @error('email') is-invalid @enderror"
                            type="email" id="email" placeholder="{{__('auth.email')}}" value="{{ old('email') }}" name="email"
                            required
                            autocomplete="off" autofocus/>
                        @error('email')
                        <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password"
                               class="form-label  tw-text-[14px] text-dark tw-opacity-60 tw-leading-[21px] font-weight-normal">@lang('auth.password')</label>
                        <input
                            class="form-control  tw-rounded-sm tw-border-[#AAAAAA] tw-py-6  tw-text-[14px] @error('password') is-invalid @enderror"
                            type="password" id="password"
                            placeholder="{{__('auth.password')}}" name="password" required autocomplete="off"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="d-flex flex-column flex-lg-row align-items-start tw-gap-4 lg:tw-gap-0 justify-content-between mb-4">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input rounded-0" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label
                                class="custom-control-label tw-text-xs lg:tw-text-sm text-dark tw-leading-[21px] font-weight-normal"
                                for="remember">
                                @lang('auth.remember_this_device')
                            </label>
                        </div>
                        <div>
                            <a href=""
                               class="text-primary tw-text-xs lg:tw-text-sm text-decoration-none tw-leading-[21px] font-weight-normal  text-primary">
                                @lang('auth.forgot_password') ?
                            </a>
                        </div>
                    </div>

                    <div class="my-2">
                        <button type="submit"
                                class="btn btn-accent tw-font-semibold tw-py-4 w-100  tw-text-[14px] text-white tw-rounded-sm hover:tw-ring-2 tw-ring-accent tw-ring-offset-2">
                            @lang('auth.sign_in')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <p class="text-center tw-text-xs tw-text-gray-100 mb-0 py-3 ">© Copyright 2023, All Rights Reserved by RURA</p>
</div>


</body>
</html>
