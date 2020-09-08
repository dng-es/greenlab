@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
@if (Auth::user()->hasRole('admin'))
{{ Breadcrumbs::render('members') }}
@else
{{ Breadcrumbs::render('members_seller') }}
@endif

@include('layouts.messages')

<div class="row">
    <div class="col-md-1">
        <button class="btn btn-primary float-right" title="{{ __('general.New') }}" data-toggle="modal" data-target="#memberModal"><i class="fa fa-plus"></i></button>
    </div>
    @if (Auth::user()->hasRole('admin'))
    <div class="col-md-4">
        <export btnstyle="btn-primary" url="{{ route('members.export') }}" label="{{ __('general.Export') }}" btnstyle="btn-success" dates="false"></export>
    </div>
    @endif
    <div class="col-md-5">
        <search btnstyle="btn-primary" label="{{ __('general.Search') }}" btnstyle="btn-primary" inputvalue="{{ $search }}"></search>
    </div>
    <div class="col-md-2 text-right">
        <div class="mt-10">Total: <b>{{ $members->total() }}</b></div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th><orderby field="vat" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Vat') }}</th>
                <th><orderby field="last_name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Member') }}</th>
                <th class="text-right"><orderby field="credit" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Credit') }}</th>
                <th class="text-right"><orderby field="telephone" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Telephone') }}</th>
                <th><orderby field="email" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Email') }}</th>
                <th class="text-right"><orderby field="active" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Active') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $element)
            <tr>
                <td><a title="{{ __('general.Edit') }}" href="{{ route('member.edit', ['member' => $element->id]) }}">{{ $element->vat }}</a></td>
                <td>
                    {{ $element->last_name }}, {{ $element->name }}</em></small>
                    @if ($element->notes != '')
                        <br><small><em class="text-danger">{{ $element->notes }}</em></small>
                    @endif
                </td>
                <td class="text-right">
                    {{ $element->credit }} <span class="text-muted">{{  __('app.Coin') }}</span>
                </td>
                <td class="text-right">{{ $element->telephone }}</td>
                <td>
                    {{ $element->email }}
                </td>
                <td class="text-right">
                    @if ($element->active == 1)
                        <i class="fa fa-check text-success"></i>
                    @else
                        <i class="fa fa-times text-danger"></i>
                    @endif
                </td>
                <td class="text-right">
                    <a class="btn btn-sm btn-outline-info" title="{{ __('app.Sell_new') }}" href="{{ route('sell', ['member' => $element->id]) }}"><i class="fa fa-cart-plus"></i></a> 
                    
                    <a class="btn btn-sm btn-outline-secondary" title="{{ __('general.Edit') }}" href="{{ route('member.edit', ['member' => $element->id]) }}"><i class="fa fa-edit"></i></a> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $members->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order])->links() }}

<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('app.New_member') }}</h5>
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
<script type="text/javascript" src="{{ url('js/member.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webcam.js') }}"></script>
@endsection
