@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('suppliers') }}

@include('layouts.messages')

<div class="row">
    <div class="col-md-1">
        <a  class="btn btn-primary float-right" href="{{ route('supplier.new') }}" title="{{ __('general.New') }}"><i class="fa fa-plus"></i></a> 
        <br />
    </div>
    <div class="col-md-5">
        <search btnstyle="btn-primary" label="{{ __('general.Search') }}" btnstyle="btn-primary" inputvalue="{{ $search }}"></search>
    </div>
    <div class="col-md-2 text-right">
        <div class="mt-10">{{ __('app.Total') }}: <b>{{ $suppliers->total() }}</b></div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th><orderby field="name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Name') }}</th>
                <th><orderby field="notes" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Notes') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $element)
            <tr>
                <td>{{ $element->name }}</td>
                <td>{{ $element->notes }}</td>
                <td class="text-right">
                    <a class="btn btn-sm btn-outline-secondary" title="{{ __('general.Edit') }}" href="{{ route('supplier.edit', ['supplier' => $element->id]) }}"><i class="fa fa-edit"></i></a> 
                    <button class="btn btn-sm btn-outline-danger btn-confirm" data-confirmbtn="{{ __('general.Delete') }}" data-msg="{{ __('general.SureToDelete') }}?" data-url="{{ route('supplier.destroy', ['supplier' => $element->id]) }}" title="{{ __('general.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $suppliers->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order])->links() }}

@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
@endsection
