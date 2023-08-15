<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{$title??'' }} @yield('title') {{ config('app.name', 'CMS-RWSS') }}</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/icon type"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
@livewireStyles
</head>
<body class="bg">
<div class="d-flex justify-content-between flex-column tw-min-h-screen">
    <div>
        <x-nav/>
        @yield('content')
        @if(isset($slot))
            {{ $slot }}
        @endif
    </div>

    <p class="text-center text-white  py-4 opacity-50 mb-0">© Copyright 2023, Done with <i class="fas fa-heart"
                                                                                             style="color: red"></i>
        by <a href="https://rw.linkedin.com/in/jules-fabien-98448795" class="text-white">Jules Fabien</a></p>

</div>

<script src="{{ mix('js/app.js') }}"></script>
@livewireScripts
@yield('scripts')
</body>
</html>
