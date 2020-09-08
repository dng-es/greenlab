@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('expenses') }}

@include('layouts.messages')

<div class="row">
    <div class="col-md-6">
        <export btnstyle="btn-primary" url="{{ route('expenses.export') }}" label="{{ __('general.Export') }}" btnstyle="btn-success" dates="true"></export>
        <br />
    </div>
    <div class="col-md-3">
        <search btnstyle="btn-primary" label="{{ __('general.Search') }}" btnstyle="btn-primary" inputvalue="{{ $search }}"></search>
    </div>
    <div class="col-md-2 text-right">
        <div class="mt-10">Total: <b>{{ $expenses->total() }}</b></div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th><orderby field="suppliers.name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Supplier') }}</th>
                        <th class="text-left"><orderby field="notes" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Notes') }}</th>
                        <th class="text-right"><orderby field="total" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Total') }}</th>
                        <th class="text-right"><orderby field="expenses.date_at" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Date') }}</th>
                        <th class="text-right"><orderby field="expenses.created_at" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Created_at') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $element)
                    <tr>
                        <td>{{ $element->supplier }}</td>
                        <td class="text-left"><small>{{ $element->notes }}</small></td>
                        <td class="text-right">{{ $element->total }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                        <td class="text-right"><small>{{ $element->date_at->format('Y-m-d') }}</small></td>
                        <td class="text-right"><small>{{ $element->created_at }}</small></td>
                        <td class="text-right">
                            <button class="btn btn-sm btn-outline-danger btn-confirm" data-confirmbtn="{{ __('general.Delete') }}" data-msg="{{ __('general.SureToDelete') }}" data-url="{{ route('expense.destroy', ['expense' => $element->id]) }}" title="{{ __('general.Delete') }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $expenses->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order])->links() }}
    </div>
    <div class="col-md-4">
        @include('expenses.partials.new')
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
<script type="text/javascript" src="{{ url('js/expenses.js') }}"></script>
@endsection
