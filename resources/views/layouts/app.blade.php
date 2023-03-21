<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ config('app.name', 'CMS-RWSS') }}</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/icon type"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick/slick-theme.css') }}">
    <style>
        .slick-prev:before,
        .slick-next:before {
            color: black;
        }
    </style>
</head>
<body class="bg">
<x-nav/>
@yield('content')

<p class="text-center text-white  py-4 opacity-50 mb-0">© Copyright 2023, All Rights Reserved by RURA</p>

{{--<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>--}}
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
