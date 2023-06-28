@extends('layouts.app')
@section('title',trans('app.home_page'))
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick/slick-theme.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
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
            <div class="col-lg-7 col-md-7 col-xl-7 my-2">
                <div>
                    <div class="mb-4">
                        <h1 class="text-white tw-text-xl md:tw-text-2xl lg:tw-text-3xl md:tw-leading-loose font-weight-bolder md:mb-3  ">
                            {{__('app.CUSTOMER_MANAGEMENT')}}
                        </h1>
                        <h1 class="text-white tw-text-xl md:tw-text-2xl lg:tw-text-4xl md:tw-leading-loose font-weight-bolder md:mb-2  ">
                            {{__('app.SYSTEM(CMS)')}}
                        </h1>
                    </div>
                    <h2 class="mb-4  tw-text-sm md:tw-text-2xl lg:tw-text-2xl text-accent font-weight-bolder tw-tracking-widest text-uppercase">
                        {{__('app.for_rural_water_supply_services')}}
                    </h2>
                </div>
                <div>
                    <p class="tw-text-gray-300 mb-4  tw-tracking-wide">
                        {{__('app.empowering_private_water_operators_for_sustainable_water_management')}} <br>
                        {{__('app.reducing_financial_loss_and_non-revenue_water.')}}
                    </p>
                    <div class="d-flex tw-gap-6 justify-content-center justify-content-sm-start">
                        @if(auth('client')->check())
                            <a href="{{ route('home') }}"
                               class="btn bg-white tw-rounded-sm py-2 px-4 hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary">
                                {{__('app.go_to_dashboard')}}
                                <svg class="tw-w-3 tw-h-3 tw-ml-2" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        @else
                            {{--                            <a href="{{route('client.login')}}"--}}
                            {{--                               class="btn  bg-accent tw-rounded-sm py-2 px-4 hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary">--}}
                            {{--                                {{__('app.login')}}--}}
                            {{--                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login"--}}
                            {{--                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75"--}}
                            {{--                                     stroke="currentColor"--}}
                            {{--                                     fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
                            {{--                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                            {{--                                    <path--}}
                            {{--                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>--}}
                            {{--                                    <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>--}}
                            {{--                                </svg>--}}
                            {{--                            </a>--}}
                            <a href="{{route('client.register')}}"
                               class="btn bg-accent text-white tw-rounded-sm py-2 px-4 hover:tw-bg-accent hover:tw-ring-2 tw-ring-offset-2 tw-ring-accent/20 tw-ring-offset-primary">
                                {{__('app.register')}}
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
            <div class="col-md-5 col-lg-5 col-xl-5 ">
                <div class="card card-body py-5 tw-rounded-xl">
                    <form method="post" id="myform" action="{{ route('client.login') }}" autocomplete="off">
                        @csrf
                        <h5 class="text-primary font-weight-bolder mb-3">{{__('auth.login_form')}}</h5>
                        <p class="">
                            {{__('auth.please_enter_your_login_details_to_access_your_account.')}}
                        </p>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">{{__('auth.email_address')}}</label>

                            <div>
                                <input id="email" type="email"
                                       class="form-control tw-rounded-md {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">{{__('auth.password')}}</label>
                            <div class="position-relative">
                                <input id="password" type="password"
                                       class="form-control tw-rounded-md {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password">
                                <button type="button"

                                        class="position-absolute  btn p-0 tw-top-1 shadow-none tw-right-4 "
                                        onclick="showPassword()">
                                    <i class="ti ti-eye tw-text-xl"
                                       id="eye"></i>
                                </button>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <a class="d-block" href="{{ url('/client/password/reset') }}">
                                {{__('auth.forgot_your_password?')}}
                            </a>
                        </div>
                        <div class="form-group d-flex flex-column flex-lg-row  align-items-center">
                            <button type="submit" class="btn btn-primary w-100">
                                {{__('auth.login')}}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <h3 class="text-white font-weight-bold mt-2">
            {{__('app.steps')}}
        </h3>
        <div class="row">
            <div class="col-sm-6 my-2 col-lg-3">
                <a>

                </a>
                <x-feature-card title="{{__('app.registration')}}"
                                description="{{__('app.register_description')}}">
                    {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" width="24"--}}
                    {{--                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"--}}
                    {{--                         stroke-linecap="round" stroke-linejoin="round">--}}
                    {{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                    {{--                        <path--}}
                    {{--                            d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2"></path>--}}
                    {{--                    </svg>--}}
                    <h1 class="  mb-0  font-weight-bold">1</h1>
                </x-feature-card>
            </div>
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="{{__('app.customer_login')}}"
                                description="{{__('app.customer_login_description')}}">
                    <h1 class="font-weight-bold mb-0 tw- ">2</h1>
                    {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24"--}}
                    {{--                         height="24"--}}
                    {{--                         viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"--}}
                    {{--                         stroke-linecap="round"--}}
                    {{--                         stroke-linejoin="round">--}}
                    {{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                    {{--                        <path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>--}}
                    {{--                        <path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>--}}
                    {{--                        <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2"></path>--}}
                    {{--                    </svg>--}}
                </x-feature-card>
            </div>
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="{{__('app.steps_new_request')}}"
                                description="{{__('app.steps_new_request_description')}}">
                    {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-devices-check"--}}
                    {{--                         width="24"--}}
                    {{--                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"--}}
                    {{--                         stroke-linecap="round" stroke-linejoin="round">--}}
                    {{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                    {{--                        <path d="M13 15.5v-6.5a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v4"></path>--}}
                    {{--                        <path d="M18 8v-3a1 1 0 0 0 -1 -1h-13a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h7"></path>--}}
                    {{--                        <path d="M16 9h2"></path>--}}
                    {{--                        <path d="M15 19l2 2l4 -4"></path>--}}
                    {{--                    </svg>--}}
                    <h1 class="font-weight-bold mb-0 ">3</h1>
                </x-feature-card>
            </div>
            <div class="col-sm-6 my-2 col-lg-3">
                <x-feature-card title="{{__('app.steps_bills_payment')}}"
                                description="{{__('app.steps_bills_payment_description')}}">
                    {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calculator" width="24"--}}
                    {{--                         height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"--}}
                    {{--                         stroke-linecap="round" stroke-linejoin="round">--}}
                    {{--                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                    {{--                        <path--}}
                    {{--                            d="M4 3m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>--}}
                    {{--                        <path d="M8 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z"></path>--}}
                    {{--                        <path d="M8 14l0 .01"></path>--}}
                    {{--                        <path d="M12 14l0 .01"></path>--}}
                    {{--                        <path d="M16 14l0 .01"></path>--}}
                    {{--                        <path d="M8 17l0 .01"></path>--}}
                    {{--                        <path d="M12 17l0 .01"></path>--}}
                    {{--                        <path d="M16 17l0 .01"></path>--}}
                    {{--                    </svg>--}}
                    <h1 class="font-weight-bold mb-0 ">4</h1>
                </x-feature-card>
            </div>
        </div>

    </div>
    <div class="py-4 tw-bg-gray-50 tw-bg-opacity-100">

        <h4 class="text-center">
            {{__('app.more_than')}} {{ $operators->count() }} {{__('app.private_water_operators')}}
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
        function showPassword() {
            let password = document.getElementById("password");
            let icon = document.getElementById("eye");
            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("ti-eye");
                icon.classList.add("ti-eye-off");
            } else {
                password.type = "password";
                icon.classList.remove("ti-eye-off");
                icon.classList.add("ti-eye");
            }

        }
    </script>
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
