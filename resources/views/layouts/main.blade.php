<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ config('app.name', 'CMS-RWSS') }}</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/icon type"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    @yield('styles')
    @livewireStyles
</head>
<body class="bg-white">
<div class="tw-min-h-screen d-flex flex-column">
    <div class="flex-grow-1">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom tw-bg-no-repeat tw-bg-center"
             style="background-image: url({{ asset('images/aside_bg.png') }})">
            <div class="lg:tw-px-20 container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" class="tw-h-10" alt=""/>
                </a>
                <button x-data="{open:false}" @click="open=!open" class="navbar-toggler shadow-none rounded-0 border-0" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti ti-menu-2" x-show="!open"></span>
                    <span class="ti ti-x" x-show="open"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                                <span>Requests</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                                <span>Billing</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex tw-gap-1 align-items-center tw-text-l tw-font-semibold" href="#">
                                <span>Payments</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link tw-text-l tw-font-semibold dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown"
                               aria-expanded="false">
                                John Doe
                            </a>
                            <div class="dropdown-menu dropdown-menu-right tw-shadow tw-rounded">
                                <a class="dropdown-item tw-text-l" href="#">
                                    <span class="ti ti-user tw-text-[20px]"></span>
                                    Profile
                                </a>
                                <a class="dropdown-item tw-text-lg" href="#">
                                    <span class="ti ti-settings-2 tw-text-[20px]"></span>
                                    Account
                                </a>
                                <a class="dropdown-item tw-text-lg" href="#">
                                    <span class="ti ti-square-asterisk tw-text-[20px]"></span>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item tw-text-lg" href="#">
                                    <span class="ti ti-logout tw-text-[20px]"></span>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="lg:tw-px-20 container-fluid my-4">
            @yield('breadcrumbs')
            @yield('content')
        </main>
    </div>
    <p class="text-center tw-text-gray-500  py-4  mb-0">© Copyright 2023, All Rights Reserved by RURA</p>
</div>

{{--<div class="d-flex tw-w-full tw-min-h-screen">
    <x-layouts.aside/>
    <div class="flex-column d-flex flex-grow-1">
        <x-clients.navbar/>
        <main class="my-2 tw-px-8">
            @yield('breadcrumbs')
            @yield('content')
        </main>
    </div>
</div>--}}


<script src="{{ asset('js/app.js') }}"></script>
@livewireScripts
@yield('scripts')
</body>
</html>
