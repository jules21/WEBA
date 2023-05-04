@extends('client.layout.guest')
@section('title', 'Reset password')
@section('content')
    <div class="form-v4-content " style="margin-top: 100px !important;">
        <div class="form-left">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
            </div>
            <h2>Fogot Password</h2>
            <p class="text-1">
               Please enter your email address to reset your password.
                {{--                To get started, please fill out the registration form below.--}}
                <br>
                Remembered Your credentials! Click the button below to log in.
            </p>
            <div class="form-left-last">
                <a href="{{ route('client.login') }}" class="btn btn-outline-light">Login here
                </a>
            </div>
        </div>
        <form class="form-detail" action="{{ url('/client/password/email') }}" method="post" id="myform">
            @csrf
            <h2>Reset Password</h2>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif


            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection


