@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2>{{ __('general.Profile') }}</h2>

    @include('layouts.messages')
    
    <div class="row">
        <div class="col-md-6 mt-4">
            <h3 class="text-muted">Datos personales</h3>
            <form class="" method="POST" action="" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="sr-only">Email:</label>
                    <input type="text" name="email" id="email" disabled class="form-control" value="{{ Auth::user()->email }}" />
                    <small id="emailHelp" class="form-text text-muted">El email es tu usuario para acceder a la Web</small>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="sr-only">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" />
                    
                    @error('name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted">Introduce tu nombre personal</small>
                </div>

                <button type="submit" class="btn btn-outline-primary btn-lg">Guardar cambios</button>

            </form>
        </div>
        <div class="col-md-6 mt-4">
            <h3 class="text-muted">Contraseña</h3>
            <form method="POST" action="{{ route('profile.changePassword') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="current-password" class="sr-only control-label">Contraseña actual:</label>
                    <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required>

                    @error('current-password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted">Introduce tu contraseña actual</small>
                </div>

                <div class="form-group">
                    <label for="new-password" class="sr-only control-label">Nueva contraseña:</label>
                    <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" required>

                    @error('new-password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted">Introduce la nueva contraseña</small>
                </div>

                <div class="form-group">
                    <label for="new-password_confirmation" class="sr-only control-label">Repetir nueva contraseña:</label>
                    <input id="new-password_confirmation" type="password" class="form-control" name="new-password_confirmation" required>

                    <small id="emailHelp" class="form-text text-muted">Repite la nueva contraseña</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary btn-lg">{{ __('general.Update_password') }}</button>
                </div>
            </form>                            
        </div>
    </div>
                
</div>
@endsection
