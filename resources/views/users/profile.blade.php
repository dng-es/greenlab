@extends('layouts.appadmin')

@section('content_admin')

{{ Breadcrumbs::render('profile') }}
<div class="container py-4">

    @include('layouts.messages')
    
    <div class="row">
        <div class="col-md-6 mt-4">
            <h3 class="text-muted">{{ __('app.Personal_information') }}</h3>
            <form class="" method="POST" action="" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="sr-only">Email:</label>
                    <input type="text" name="email" id="email" disabled class="form-control" value="{{ Auth::user()->email }}" />
                    <small id="emailHelp" class="form-text text-muted">{{ __('general.Email_legend') }}</small>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="sr-only">{{ __('general.Name') }}:</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" />
                    
                    @error('name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted">{{ __('general.NameUser_legend') }}</small>
                </div>

                <button type="submit" class="btn btn-outline-primary btn-lg">{{ __('general.SaveData') }}</button>

            </form>
        </div>
        <div class="col-md-6 mt-4">
            <h3 class="text-muted">{{ __('general.Password') }}</h3>
            <form method="POST" action="{{ route('profile.changePassword') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="current-password" class="sr-only control-label">{{ __('general.Current_password') }}:</label>
                    <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required>

                    @error('current-password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted">{{ __('general.Current_password') }}</small>
                </div>

                <div class="form-group">
                    <label for="new-password" class="sr-only control-label">{{ __('general.New_password') }}:</label>
                    <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" required>

                    @error('new-password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted">{{ __('general.New_password') }}</small>
                </div>

                <div class="form-group">
                    <label for="new-password_confirmation" class="sr-only control-label">{{ __('general.New_password_repeat') }}</label>
                    <input id="new-password_confirmation" type="password" class="form-control" name="new-password_confirmation" required>

                    <small id="emailHelp" class="form-text text-muted">{{ __('general.New_password_repeat') }}</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary btn-lg">{{ __('general.Update_password') }}</button>
                </div>
            </form>                            
        </div>
    </div>
                
</div>
@endsection
