@extends('layouts.appadmin')

@section('css')

@endsection

@section('content_admin')

@include('layouts.messages')

{{ Breadcrumbs::render('locales') }}

<div class="container">
    <form class="" method="POST" action="">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12 text-right">
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                    </button> 
                </div>
            </div>
        </div>
        
        <div class="row">     
            @foreach($locales as $key => $locale) 
            <div class="col-md-4">
                <div class="form-group">
                    <label for="{{ $key }}" class="control-label text-primary">{{ __('general.Tag') }}: <em class="text-secondary">{{ $key }}</em></label>
                    <input id="{{ $key }}" type="text" class="form-control @error($key) is-invalid @enderror" name="{{ $key }}" value="{{ $locale }}" required autofocus>
                    @error($key)
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>  
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                    </button> 
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection
