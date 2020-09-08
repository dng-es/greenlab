@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('site') }}

@section('css')
@endsection

@include('layouts.messages')       

<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('general.Name') }}</label>
                        <input id="name" type="text" class="form-control " name="name" value="{{ $site->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="lang" class="control-label">{{ __('general.DefaultLanguage') }}</label>
                        <select id="lang" class="selectpicker show-tick" name="lang" required data-width="100%">
                            <option value="es" @php echo ($site->lang == 'es' ? ' selected="selected" ' : '');@endphp>es</option>
                            <option value="en" @php echo ($site->lang == 'en' ? ' selected="selected" ' : '');@endphp>en</option>
                        </select>
                    </div>  
         

                    <div class="form-group">
                        <label for="logo" class="control-label">Logo <small>(png, gif)</small></label>
                        <input type="file" id="logo" name="logo" data-text="{{ __('general.ChooseFile') }}" class="filestyle btn-block" aria-describedby="file" accept="image/png, image/gif">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-save text-white"></i> {{ __('general.SaveData') }}</button> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <img src="{{ $site->logoSite() }}" style="width: 250px" class="ml-5" />
        </div>
    </div>
</form>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/bootstrap-filestyle-2.1.0/src/bootstrap-filestyle.min.js') }}"></script>
@endsection
