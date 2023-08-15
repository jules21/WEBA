<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') {{ config('app.name', 'CMS-RWSS') }}</title>
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
    <link rel="stylesheet" href="{{asset('css/guest.css')}}">
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="admin-bg">
<div class="min-vh-100 d-flex flex-column justify-content-between">
    <div class="flex-grow-1">
        <x-clients.nav/>
        <div class="container-fluid lg:tw-px-20">
            @yield('content')
        </div>
    </div>
    <p class="text-center text-white  py-4 opacity-50 mb-0">© Copyright 2023, Done <i class="fas fa-heart"
                                                                                           style="color: red"></i>
        by <a href="https://rw.linkedin.com/in/jules-fabien-98448795" class="text-white">Jules Fabien</a></p>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
