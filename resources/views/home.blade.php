@extends('layouts.app')

@section('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('layouts.messages')

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-8 text-center">
            {{ csrf_field() }}
            @include('members.partials.search')
            <br>
            <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#memberModal"><i class="fa fa-plus-circle"></i> {{ __('app.New_member') }}</button> 
            <a target="_blank" href="{{ route('menu') }}" class="btn btn-lg btn-primary"><i class="fa fa-eye"></i> {{ __('app.Menu') }}</a>
            <br>
            <img src="{{ session()->get('site')->logoSite() }}" style="width: 250px" class="mt-5" />
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('app.Member') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('members.partials.new')
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webcam.js') }}"></script>
<script type="text/javascript" src="{{ url('js/member.js') }}"></script>
<script type="text/javascript" src="{{ url('js/search.js') }}"></script>
@endsection
