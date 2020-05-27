@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mt-5" style="border-radius: 1rem !important;">
                <div class="card-body">
                    <h4 class="card-title text-center mb-5">{{ __('Reset Password') }}</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="sr-only col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="rounded-pill form-control-lg form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill btn-lg">
                                {{ __('Send Password Reset Link') }}
                            </button>

                            <hr>
                            <a class="btn btn-success btn-block rounded-pill btn-lg" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
