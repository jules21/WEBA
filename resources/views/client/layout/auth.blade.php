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
<body class="bg-white">
<div class="tw-min-h-screen d-flex flex-column">
    <div class="flex-grow-1">
        <x-clients.navbar/>
        <main class="lg:tw-px-20 container-fluid my-4">
            @yield('breadcrumbs')
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 card-body tw-rounded">
                        <ul class="nav flex-column tw-gap-2">
                            <li class="nav-item">
                                <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 active" href="#">
                                    <div
                                        class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle">
                                        <i class="ti ti-smart-home tw-text-[24px]"></i>
                                    </div>
                                    <div>
                                        <div>Home</div>
                                        <div class="tw-text-sm  text-muted">Summary</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 active" href="#">
                                    <div
                                        class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle">
                                        <i class="ti ti-receipt tw-text-[24px]"></i>
                                    </div>
                                    <div>
                                        <div>Billing</div>
                                        <div class="tw-text-sm  text-muted">
                                            View your bills
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 active" href="#">
                                    <div
                                        class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle">
                                        <i class="ti ti-building-bank tw-text-[24px]"></i>
                                    </div>
                                    <div>
                                        <div>Payments</div>
                                        <div class="tw-text-sm text-muted">
                                            View your payments history
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 active" href="#">
                                    <div
                                        class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle">
                                        <i class="ti ti-notification tw-text-[24px]"></i>
                                    </div>
                                    <div>
                                        <div>Notifications</div>
                                        <div class="tw-text-sm text-muted">
                                            Your notifications at a glance
                                        </div>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                    <div class="card mb-4 card-body tw-rounded">
                        <h4>
                            My Operators
                        </h4>


                        <ul class="list-unstyled mt-4">
                            @foreach($recentOperators??[] as $item)
                                <li class="media mb-3">
                                    <img src="{{ $item->logo_url }}" class="mr-3 tw-w-10" alt="...">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">
                                            {{ $item->name }}
                                        </h5>
                                        <p class="mb-1">
                                            {{ $item->address }}
                                        </p>
                                        <div class="d-flex tw-gap-1 justify-content-between">
                                            <a href=""
                                               class="btn btn-sm tw-bg-primary/10 tw-text-primary font-weight-bolder hover:tw-bg-primary hover:tw-text-white">
                                                <span class="ti ti-plus d-none d-lg-inline"></span>
                                                New Connection
                                            </a>
                                            <a href=""
                                               class="btn btn-sm tw-bg-primary/20 tw-text-primary hover:tw-bg-primary hover:tw-text-white">
                                                <span class="ti ti-receipt d-none d-lg-inline"></span>
                                                Billing
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
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
@livewireScripts
@yield('scripts')
</body>
</html>
