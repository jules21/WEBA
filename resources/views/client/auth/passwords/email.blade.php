@extends('client.layout.guest')
@section('title', 'Reset password')
@section('content')
    <div class="tw-mt-20 tw-rounded-xl overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-4 col-lg-5">
                <div class="text-white p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"/>
                    </div>
                    <h2 class="mb-4 ">{{__('auth.forgot_password')}}</h2>
                    <p class="">
                        {{__('auth.please_enter_your_email_address_to_reset_your_password.')}}
                        <br>
                        <br>
                        {{__('auth.remembered_your_credentials_lick_the_button_below_to_log_in.')}}
                    </p>
                    <a href="{{ route('welcome') }}" class="btn btn-outline-light tw-mt-10">{{__('auth.login_here')}}</a>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 col-lg-5 bg-white card-body tw-rounded-xl">
                <form class="p-4" action="{{ url('/client/password/email') }}" method="post"  autocomplete="off">
                    @csrf
                    <h2 class="text-primary text-center font-weight-bolder mb-5">{{__('auth.reset_password')}}</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

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
                    <div class="form-group row mt-4">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary  tw-rounded-md">
                                {{__('auth.send_password_reset_link')}}
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


