@extends('client.layout.guest')
@section('title', 'Login')
@section('content')
    <div class="form-v4-content " style="margin-top: 100px !important;">
        <div class="form-left">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
            </div>
            <h2>Account Login</h2>
            <p class="text-1">
                Welcome back to our system! <br> Please enter your login details to access your account.
                {{--                To get started, please fill out the registration form below.--}}
            </p>
            <p class="text-2">
                If you don't have an account yet, please click on the button below to register.
            </p>
            <div class="form-left-last mb-4">
                <a href="{{ route('client.register') }}" class="btn btn-outline-light">Create an account
                </a>
            </div>
        </div>
        <form class="form-detail" action="#" method="post" id="myform" action="{{ route('client.login') }}">
            @csrf
            <h2>Login Form</h2>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

{{--            <div class="form-checkbox">--}}
{{--                <label class="container"><p>Remember Me</p>--}}
{{--                    <input type="checkbox" name="remember">--}}
{{--                    <span class="checkmark"></span>--}}
{{--                </label>--}}
{{--            </div>--}}

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <a class="btn btn-link" href="{{ url('/client/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection


