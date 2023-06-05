@extends('client.layout.guest')
@section('title', 'Reset password')
@section('content')
    <div class="tw-mt-20 tw-rounded-xl overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-white p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                    </div>
                    <h2 class="mb-4">Reset Password</h2>
                    <p class="text-1">
                        Please enter your email address and new password to reset your password.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 bg-white card-body tw-rounded-xl">
                <form class="p-4" action="{{ url('/client/password/reset') }}" method="post" autocomplete="off">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <h2 class="text-primary font-weight-bolder mb-5">Set New Password</h2>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row my-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control tw-rounded-md {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control tw-rounded-md {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control tw-rounded-md {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group row mt-4">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary  tw-rounded-md">
                                Reset Password
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


