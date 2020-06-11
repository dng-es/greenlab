@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('warehouses') }}

@include('layouts.messages')

<div class="row">
    <div class="col-md-6">
        <export btnstyle="btn-primary" url="{{ route('warehouses.export', ['type' => $type]) }}" label="{{ __('general.Export') }}" btnstyle="btn-success" dates="true"></export>
        <br />
    </div>
    <div class="col-md-3">
        <search btnstyle="btn-primary" label="{{ __('general.Search') }}" btnstyle="btn-primary" inputvalue="{{ $search }}"></search>
    </div>
    <div class="col-md-2 text-right">
        <div class="mt-10">Total: <b>{{ $warehouses->total() }}</b></div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        @include('warehouses.partials.list', ['warehouses' => $warehouses, 'search' => $search, 'orderby' => $orderby, 'order' => $order])        
    </div>

    <div class="col-md-4">
        <div class="card border-0">
            <div class="card-body">
                @include('warehouses.partials.new')
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
<script type="text/javascript" src="{{ url('js/warehouse.js') }}"></script>
@endsection
