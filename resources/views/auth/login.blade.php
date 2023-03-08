<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../../../">
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('css/master.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('assets/logos/logo.svg') }}"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
             style="background-image: url({{ asset('assets/media/bg/bg-3.jpg') }});">
            <div class="login-form text-center mx-3 p-7 position-relative overflow-hidden rounded border shadow-xs">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-10">
                    <a href="#">
                        <img src="{{ asset('img/logo.png') }}" class="max-h-50px" alt=""/>
                    </a>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-10">
                        <h3>Sign In</h3>
                        <h4>CMS RWSS</h4>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account</div>
                    </div>
                    <form class="form" id="kt_login_signin_form" action="{{ route('login') }}" autocomplete="off"
                          method="post">
                        @csrf
                        <div class="form-group mb-5">
                            <input
                                class="form-control h-auto form-control-solid py-4 px-8 @error('email') is-invalid @enderror"
                                type="email" id="email" placeholder="Email" value="{{ old('email') }}" name="email"
                                required
                                autocomplete="off" autofocus/>
                            @error('email')
                            <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <input
                                class="form-control h-auto form-control-solid py-4 px-8 @error('password') is-invalid @enderror"
                                type="password" id="password"
                                placeholder="Password" name="password" required autocomplete="off"/>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                         <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <label class="checkbox m-0 text-muted">
                                <input type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }} />
                                Remember me
                                <span></span>
                            </label>
                        </div>
                        <button id="kt_login_signin_submit"
                                class="btn btn-primary btn-block font-weight-bold py-4 my-3">
                            Sign In
                        </button>
                    </form>
                    <div class="mt-10">
                        <a href="{{ url('/password/reset') }}" id="kt_login_forgot" class="text-dark-75 text-hover-primary">
                            Forget Password ?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };</script>
{{--<script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script>--}}
</body>
</html>
