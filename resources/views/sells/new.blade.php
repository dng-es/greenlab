@extends('layouts.appadmin')

@section('css')

@endsection

@section('content_admin')

<div id="alert-sell" class="text-right alert-app alert alert-success fade show" role="alert" style="display:none">
    <button type="button" class="close" aria-label="Close" onclick="$('#alert-sell').hide()">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="clearfix"></div>
    <p><i class="fas fa-check"></i> <span id="alert-msg"></span></p>
</div>

<div class="row">
    <div class="col-md-3 text-center">
        <div class="imageProfile rounded-lg">            
            <img src="{{ $member->imageProfile() }}" width="100%" class="mb-3" />
            <h3 class="sectionHeader">{{ $member->name }} {{ $member->last_name }}</h3>
            <h5 class="resumeFont"><small>{{ __('app.This_month') }}</small> <b><span id="total_month">{{ number_format($total_month, 2, '.', ',') }}</span> {{ strtolower( __('app.Grams')) }}</b></h5>

            @include('credits.partials.btn', ['member' => $member])
            
            <a title="{{ __('general.Update') }} {{ __('app.Member') }}" class="btn btn-info mt-1" href="{{ route('member.edit', ['member' => $member->id]) }}"><i class="fa fa-user text-white"></i> {{ __('general.Update') }} {{ __('app.Member') }}</a> 

            <button title="{{ __('general.History') }}" class="btn btn-info mt-1" data-toggle="modal" data-target="#historyModal">
                <i class="fa fa-file text-white"></i> 
                {{ __('general.History') }}
            </button>

            @if ($member->notes !== '')
            <h3 class="mt-3 resumeFont text-danger">{{ $member->notes }}</h3>
            @endif
        </div>
    </div>
    <div class="col-md-9">
        <div class="">
            @include('members.partials.search')
        </div>
        <form class="form-horizontal" method="POST" action="" id="sell_form" accept-charset="UTF-8" >
            {{ csrf_field() }}
            <div class="row mb-3">
                <div class="col-md-9">
                    <button class="btn btn-warning" type="submit"><i class="fa fa-shopping-cart"></i> {{ __('app.Sell_finish') }}</button> 
                    
                    <button id="credit_finish" class="btn btn-warning" type="button"><i class="fa fa-shopping-cart"></i> {{ __('app.Sell_finish_credit') }}</button> 

                    <button class="btn btn-danger" type="button" id="sell_reset"><i class="fa fa-history"></i> {{ __('app.Sell_reset') }}</button>
                </div>
                <div class="col-md-3">
                    <h3 class="sectionHeader text-right mb-0">
                        {{ __('app.Sell_total') }}: 
                        {{-- <span id="total_amount">0</span>gr. -  --}}
                        <span id="total_price">0</span>{{  __('app.Coin') }}
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

        <nav>
            <div class="nav nav-pills" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-prod1-tab" data-toggle="tab" href="#nav-prod1" role="tab" aria-controls="nav-prod1" aria-selected="true">{{ __('app.ProductMain') }}</a>
                <a class="nav-item nav-link" id="nav-prod2-tab" data-toggle="tab" href="#nav-prod2" role="tab" aria-controls="nav-prod2" aria-selected="false">{{ __('app.Bar') }}</a>
            </div>
        </nav>

        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="pr-3 pl-3 tab-pane fade show active" id="nav-prod1" role="tabpanel" aria-labelledby="nav-prod1-tab">
                @php 
                    $prod1 = $products->filter(function ($item) {
                        return ($item->bar == 0);
                    });
                @endphp

                @include('sells.partials.list', ['products' => $prod1])
            </div>
            <div class="pr-3 pl-3 tab-pane fade" id="nav-prod2" role="tabpanel" aria-labelledby="nav-prod2-tab">
                @php 
                    $prod2 = $products->filter(function ($item) {
                        return ($item->bar == 1);
                    });
                @endphp
                @include('sells.partials.list', ['products' => $prod2])
            </div>
        </div>
        </form>
    </div>
    
</div>

<!-- Credit Modal -->
<div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('app.Credit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('credits.partials.new', ['member' => $member])
            </div>
        </div>
    </div>
</div>

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('general.History') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="fa-3x loading_warehouses mt-5 text-center text-muted">
                    <i class="fas fa-spinner fa-pulse"></i>
                </div>
                <div id="warehouses" data-pourl="{{ route('members.warehouses', ['member' => $member]) }}"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('js/jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/counter.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/warehouses.js') }}"></script>
<script type="text/javascript" src="{{ url('js/sell.js') }}"></script>
<script type="text/javascript" src="{{ url('js/search.js') }}"></script>
<script type="text/javascript" src="{{ url('js/credits.js') }}"></script>
@endsection
