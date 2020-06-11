@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
@if ($bar == 1)
{{ Breadcrumbs::render('products_bar') }}
@else
{{ Breadcrumbs::render('products') }}
@endif

@include('layouts.messages')

<div class="row">
    <div class="col-md-1">
        <a  class="btn btn-primary float-right" href="{{ route('product.new', ['bar' => $bar]) }}" title="{{ __('general.New') }}"><i class="fa fa-plus"></i></a> 
    </div>
    <div class="col-md-4">
        <export btnstyle="btn-primary" url="{{ route('products.export') }}" label="{{ __('general.Export') }}" btnstyle="btn-success" dates="false"></export>
    </div>
    <div class="col-md-5">
        <search btnstyle="btn-primary" label="{{ __('general.Search') }}" btnstyle="btn-primary" inputvalue="{{ $search }}"></search>
    </div>
    <div class="col-md-2 text-right">
        <div class="mt-10">Total: <b>{{ $products->total() }}</b></div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th><orderby field="name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Product') }}</th>
                        <th class="text-right"><orderby field="price" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Price') }}</th>
                        <th class="text-right"><orderby field="amount" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Amount') }}</th>
                        <th class="text-right"><orderby field="menu" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Menu') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $element)
                    <tr>
                        <td>
                            {{ $element->name }} <small><em class="text-muted">{{ $element->category->name }}</em></small>
                        </td>
                        <td class="text-right">{{ number_format($element->price, 2, '.', ',') }} {{  __('app.Coin') }}</td>
                        <td class="text-right">
                            {{ number_format($element->amount, 2, '.', ',') }} 
                            @if($bar == 0)
                            <small><em class="text-muted">{{ strtolower(__('app.Grams')) }}</em></small>
                            @else
                            <small><em class="text-muted">{{ strtolower(__('app.Unit')) }}</em></small>
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($element->menu == 1)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-secondary" title="{{ __('general.Edit') }}" href="{{ route('product.edit', ['product' => $element->id, 'bar' => $bar]) }}"><i class="fa fa-edit"></i></a> 
                            <button class="btn btn-sm btn-outline-danger btn-confirm" data-confirmbtn="{{ __('general.Delete') }}" data-msg="{{ __('general.SureToDelete') }}?" data-url="{{ route('product.destroy', ['product' => $element->id]) }}" title="{{ __('general.Delete') }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $products->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order])->links() }}
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
<script type="text/javascript" src="{{ url('js/warehouse.js') }}"></script>
@endsection
