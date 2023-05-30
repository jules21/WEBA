@extends('client.layout.guest')
@section('title', trans('auth.login'))
@section('content')
    <div class="tw-mt-20 tw-rounded-xl overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-5 col-xl-5">
                <div class="text-white p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                    </div>
                    <h2 class="mb-4">{{__('auth.account_login')}}</h2>
                    <p class="text-1">
                        {{__('auth.welcome_back_to_our_system!')}} <br> {{__('auth.please_enter_your_login_details_to_access_your_account.')}}
                    </p>
                    <p class="text-2">
                        {{__('auth.if_you_dont_have_an_account_yet')}}, {{__('auth.please_click_on_the_button_below_to_register.')}}
                    </p>
                    <a href="{{ route('client.register') }}" class="btn btn-outline-light tw-mt-10">{{__('auth.create_an_account')}}</a>
                </div>
            </div>
            <div class="col-md-5  col-xl-4 bg-white card-body tw-rounded-xl">
                <form class="px-4 py-5" method="post" id="myform" action="{{ route('client.login') }}" autocomplete="off">
                    @csrf
                    <h2 class="text-primary font-weight-bolder mb-3">{{__('auth.login_form')}}</h2>

                    <div class="row my-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">{{__('auth.email_address')}}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control tw-rounded-md {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">{{__('auth.password')}}</label>
                        <div>
                            <input id="password" type="password" class="form-control tw-rounded-md {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group d-flex flex-column flex-lg-row mt-4 align-items-center">
                        <button type="submit" class="btn btn-primary mr-lg-3 tw-rounded-md tw-w-full lg:tw-w-auto mb-3 mb-lg-0">
                            {{__('auth.login')}}
                        </button>
                        <a class="d-block" href="{{ url('/client/password/reset') }}">
                            {{__('auth.forgot_your_password?')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


