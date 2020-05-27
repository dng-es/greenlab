@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('users_edit', $user) }}

@include('layouts.messages')

<form class="form-horizontal" method="POST" action="">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="created_at" class="control-label">{{ __('general.Created_at') }}</label>
                <input id="created_at" type="text" readonly="readonly" class="form-control " name="created_at" value="{{ $user->created_at }}" required>
            </div>  
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="roles" class="control-label">{{ __('general.Role') }}</label>
                <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autofocus>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" @php echo ($role->id == $user->roles->first()->id ? 'selected' : '');@endphp>{{ $role->description }}</option>
                @endforeach;
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="email" class="control-label">E-Mail</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>
                @error('email')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="name" class="control-label">{{ __('general.Name')}}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>
                @error('name')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>      
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg">
                    {{ __('general.SaveData')}}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
