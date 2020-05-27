@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('supplier_new') }}

@include('layouts.messages')

<form class="form-horizontal" method="POST" action="">
    {{ csrf_field() }}            

    <div class="form-group col-md-6">
        <label for="name" class="control-label">{{ __('general.Name')}}</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>        
 
    <div class="form-group col-md-6">
        <label for="notes" class="control-label">{{ __('general.Notes') }}</label>
        <textarea rows="5" id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>
        @error('notes')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <button type="submit" class="btn btn-warning btn-lg">
            <i class="fa fa-save text-white"></i>  {{ __('general.SaveData')}}
        </button>
    </div>
</form>
@endsection
