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

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th><orderby field="fullname" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Name') }}</th>
                <th><orderby field="product.name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Product') }}</th>
                <th class="text-right"><orderby field="amount" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Amount') }}</th>
                <th class="text-right"><orderby field="amount_real" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Amount') }} real</th>
                <th class="text-right"><orderby field="price" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Price') }}</th>
                <th class="text-right"><orderby field="total" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Total') }}</th>
                <th class="text-right"><orderby field="warehouses.created_at" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Created_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouses as $element)
            <tr>
                <td>{{ $element->fullname }}</td>
                <td>{{ $element->product }} <small class="text-muted">{{ $element->category }}</small></td>
                <td class="text-right">
                    {{ $element->amount }}
                    @if($element->bar ==0)
                    <small class="text-muted">{{  __('app.Grams') }}</small>
                    @endif
                </td>
                <td class="text-right">
                    {{ $element->amount_real }}
                    @if($element->bar ==0)
                    <small class="text-muted">{{  __('app.Grams') }}</small>
                    @endif
                </td>
                <td class="text-right">{{ $element->price }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                <td class="text-right">{{ $element->total }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                <td class="text-right"><small>{{ $element->created_at }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $warehouses->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order])->links() }}

@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
@endsection
