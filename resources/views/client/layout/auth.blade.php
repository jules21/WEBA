<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ config('app.name', 'CMS-RWSS') }}</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/icon type"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">
    @yield('styles')
    @livewireStyles
</head>
<body>
<div class="tw-min-h-screen d-flex flex-column">
    <div class="flex-grow-1">
        <x-clients.navbar/>
        <main class="lg:tw-px-20 container-fluid my-4">
            <x-alerts/>
            @yield('breadcrumbs')
            <div class="row">
                <div class="col-md-4">
                    <x-clients.sidebar/>
                </div>
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <p class="text-center tw-text-gray-500  py-4  mb-0">© Copyright 2023, All Rights Reserved by RURA</p>

</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
@livewireScripts
</body>
</html>
