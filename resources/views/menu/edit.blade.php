@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('menu') }}

@section('css')
<link href="{{ url('vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
@endsection

@include('layouts.messages')       

<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="fontsize" class="control-label">{{ __('general.Fontsize') }}</label>
                <input id="fontsize" type="number" class="form-control " name="fontsize" value="{{ $menu->fontsize }}" required>
            </div>  

            <div class="form-group">
                <label for="fontcolor" class="control-label">{{ __('general.Fontcolor') }}</label>
                <div id="cp1" class="input-group" title="Color de la categoría">
                    <input type="text" name="fontcolor" id="fontcolor" class="form-control input-lg @error('fontcolor') is-invalid @enderror" value="{{ $menu->fontcolor }}"/>
                    <span class="input-group-append">
                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                    </span>
                    @error('fontcolor')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>  

            <div class="form-group">
                <label for="background" class="control-label">{{ __('general.Background') }}</label>
                <input type="file" id="background" name="background" data-text="{{ __('general.ChooseFile') }}" class="filestyle btn-block" id="image" aria-describedby="file" accept="image/png, image/jpeg">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> {{ __('general.SaveData') }}</button> 
                <a target="_blank" href="{{ route('menu') }}" class="btn btn-success btn-block"><i class="fa fa-eye"></i> {{ __('general.Preview') }}</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="mr-4" style="min-height: 600px ;background: url({{ $menu->imageBackground() }})">
                @include('menu.partials.list', ['categories' => $categories])
            </div>
        </div>
    </div>


</form>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/bootstrap-filestyle-2.1.0/src/bootstrap-filestyle.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/menu.js') }}"></script>
@endsection
