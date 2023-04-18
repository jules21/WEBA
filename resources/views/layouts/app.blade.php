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
    @yield('styles')

</head>
<body class="bg">
<x-nav/>
@yield('content')

<p class="text-center text-white  py-4 opacity-50 mb-0">© Copyright 2023, All Rights Reserved by RURA</p>


<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
</body>
</html>
