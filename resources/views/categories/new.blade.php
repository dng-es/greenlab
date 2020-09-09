@extends('layouts.appadmin')

@section('content_admin')
@if ($bar == 1)
{{ Breadcrumbs::render('bar_new') }}
@else
{{ Breadcrumbs::render('category_new') }}
@endif

@section('css')
<link href="{{ url('vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
@endsection

@include('layouts.messages')
<div class="row">
    <div class="col-md-4">
        <div class="card border-0 mb-3">
            <div class="card-body pb-0">
                <form class="form-horizontal" method="POST" action="">
                    {{ csrf_field() }}

                    <input type="hidden" id="bar" name="bar" value="{{ $bar }}" />

                    <div class="form-group col-md-12">
                        <label for="name" class="control-label">{{ __('general.Name')}}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label for="color" class="control-label">{{ __('general.Color')}}</label>
                        <div id="cp1" class="input-group" title="Color de la categoría">
                            <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required>
                            <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                            </span>                            
                        </div>
                        @error('color')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>                            
                 
                    <div class="form-group col-md-12">
                        <label for="notes" class="control-label">{{ __('general.Notes') }}</label>
                        <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-warning btn-lg">
                            <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/category.js') }}"></script>
@endsection