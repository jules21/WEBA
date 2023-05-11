@extends('layouts.app')
@section('title','Home Page')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick/slick-theme.css') }}">
    <style>
        .slick-prev:before,
        .slick-next:before {
            color: black;
        }
    </style>
@endsection
@section('content')
    <div class="container my-md-3">
        <div class="row ">
            <div class="col-lg-8 my-2">
                <div>
                    <div class="mb-4">
                        <h1 class="text-white tw-text-xl md:tw-text-2xl lg:tw-text-5xl md:tw-leading-loose font-weight-bolder md:mb-3  tw-tracking-wide">
                            CUSTOMER MANAGEMENT
                        </h1>
                        <h1 class="text-white tw-text-xl md:tw-text-2xl lg:tw-text-5xl md:tw-leading-loose font-weight-bolder md:mb-2  tw-tracking-wide">
                            SYSTEM(CMS)
                        </h1>
                    </div>
                    <h2 class="mb-4  tw-text-sm md:tw-text-2xl text-accent font-weight-bolder tw-tracking-widest text-uppercase">
                        For Rural Water Supply Services
                    </h2>
                </div>
                <div>
                    <p class="tw-text-gray-300 mb-4  tw-tracking-wide">
                        Empowering Private Water Operators for Sustainable Water Management <br> Reducing
                        Financial Loss and Non-Revenue Water .
                    </p>
                    <div class="d-flex tw-gap-6 justify-content-center justify-content-sm-start">
                        @if(auth('client')->check())
                            <a href="{{ route('home') }}"
                               class="btn bg-white tw-rounded-sm py-2 px-4 hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary">
                                Go to Dashboard
                                <svg class="tw-w-3 tw-h-3 tw-ml-2" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{route('client.login')}}"
                               class="btn text-white bg-accent tw-rounded-sm py-2 px-4 hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary">
                                Login
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75"
                                     stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                                </svg>
                            </a>
                            <a href="{{route('client.register')}}"
                               class="btn bg-white tw-rounded-sm py-2 px-4 hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary">
                                Register
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75"
                                     stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                </svg>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-2 text-white">
                <div class="tw-grid tw-grid-cols-2 tw-gap-1 bg-primary">
                    <x-counter-card title="Population Served" :count="$totalCustomers">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-friends" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M5 22v-5l-1 -1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5"></path>
                            <path d="M17 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4"></path>
                        </svg>
                    </x-counter-card>
                    <x-counter-card title="Water Connections" :count="$totalWaterConnections">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z"
                                stroke-width="0" fill="currentColor"></path>
                        </svg>
                    </x-counter-card>
                    <x-counter-card title="Private Water Operators" :count="$operators->count()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                        </svg>
                    </x-counter-card>
                    <x-counter-card title="Water Networks" :count="$totalWaterNetworks">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-topology-bus"
                             width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 10a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z"></path>
                            <path d="M6 10a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z"></path>
                            <path d="M22 10a2 2 0 1 0 -4 0a2 2 0 0 0 4 0z"></path>
                            <path d="M2 16h20"></path>
                            <path d="M4 12v4"></path>
                            <path d="M12 12v4"></path>
                            <path d="M20 12v4"></path>
                        </svg>
                    </x-counter-card>
                </div>
            </div>
        </div>

        <h3 class="text-white font-weight-bold mt-2">
            CMS Features
        </h3>
        <div class="row">
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="Billing"
                                description="Generate accurate and timely water bills for customers, improving revenue collection and reducing financial loss.">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2"></path>
                    </svg>
                </x-feature-card>
            </div>
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="Payment"
                                description="Allow customers to have multiple payment options and a fully automated payment process, improving convenience and increasing timely payments.">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24"
                         height="24"
                         viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                        <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path>
                    </svg>
                </x-feature-card>
            </div>
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="Inventory Management"
                                description="Keep track of inventory levels, ensure adequate supply of spare parts, and optimize procurement processes for efficient operations.">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-devices-check"
                         width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 15.5v-6.5a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v4"></path>
                        <path d="M18 8v-3a1 1 0 0 0 -1 -1h-13a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h7"></path>
                        <path d="M16 9h2"></path>
                        <path d="M15 19l2 2l4 -4"></path>
                    </svg>
                </x-feature-card>
            </div>
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="Accounting"
                                description="Streamline financial management by automating accounting tasks, producing financial reports, and ensuring compliance with regulations.">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calculator" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M4 3m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                        <path d="M8 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z"></path>
                        <path d="M8 14l0 .01"></path>
                        <path d="M12 14l0 .01"></path>
                        <path d="M16 14l0 .01"></path>
                        <path d="M8 17l0 .01"></path>
                        <path d="M12 17l0 .01"></path>
                        <path d="M16 17l0 .01"></path>
                    </svg>
                </x-feature-card>
            </div>
        </div>

    </div>
    <div class="py-4 tw-bg-gray-50 tw-bg-opacity-100">

        <h4 class="text-center">
            More than {{ $operators->count() }} + Private Water Operators
        </h4>

        <section class="container">
            <div class="autoplay">
                @foreach($operators as $item)
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div
                            style="background-image: url({{ $item->logo_url }})"
                            class="d-flex justify-content-center align-items-center  rounded-circle tw-h-20 tw-w-20 tw-bg-contain tw-bg-center tw-bg-no-repeat">
                        </div>
                        <div class="fs-13">
                            {{ $item->name }}
                        </div>

                    </div>
                @endforeach
            </div>
        </section>

    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{ asset('css/slick/slick.min.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <script>
        $(document).on('ready', function () {
            $('.autoplay').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                touchMove: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 2,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 2,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
            new PureCounter();
        });

    </script>
@endsection
