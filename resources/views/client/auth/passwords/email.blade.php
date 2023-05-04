@extends('client.layout.guest')
@section('title', 'Reset password')
@section('content')
    <div class="tw-mt-20 tw-rounded-xl overflow-hidden">
        <div class="row">
            <div class="col-md-5">
                <div class="text-white p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                    </div>
                    <h2 class="mb-4">Fogot Password</h2>
                    <p class="text-1">
                        Please enter your email address to reset your password.
                        <br>
                        <br>
                        Remembered Your credentials! Click the button below to log in.
                    </p>
                    <a href="{{ route('client.login') }}" class="btn btn-outline-light tw-mt-10">Login here</a>
                </div>
            </div>
            <div class="col-md-7 bg-white card-body tw-rounded-xl">
                <form class="p-4" action="{{ url('/client/password/email') }}" method="post"  autocomplete="off">
                    @csrf
                    <h2 class="text-primary font-weight-bolder mb-5">Reset Password</h2>
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
                    <div class="form-group row mt-4">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary  tw-rounded-md">
                                Send Password Reset Link
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


