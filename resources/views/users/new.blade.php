@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('users_new') }}

@include('layouts.messages')       

<form class="form-horizontal" method="POST" action="">
    {{ csrf_field() }}

    <div class="form-group col-md-6">
        <label for="email" class="control-label">E-Mail</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>               

    <div class="form-group col-md-6">
        <label for="name" class="control-label">{{ __('general.Name')}}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="role_id" class="control-label">{{ __('general.Role') }}</label>
        <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->description }}</option>
        @endforeach;
        </select>
        @error('role_id')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>            
 
    <div class="form-group col-md-6">
        <label for="password" class="control-label">{{ __('general.Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        @error('password')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="password-confirm" class="control-label">{{ __('general.Password_confirm') }}</label>
        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
        @error('password_confirmation')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary btn-lg">
            {{ __('general.SaveData')}}
        </button>
    </div>
</form>
@endsection
