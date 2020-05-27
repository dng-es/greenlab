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
            <h5 class="resumeFont"><small>{{ __('app.This_month') }}</small> <b><span id="total_month">{{ $total_month }}</span> {{ strtolower( __('app.Grams')) }}</b></h5>

            @include('credits.partials.btn', ['member' => $member])
            
            <a title="{{ __('general.Update') }} {{ __('app.Member') }}" class="btn btn-success btn-lg" href="{{ route('member.edit', ['member' => $member->id]) }}"><i class="fa fa-user"></i> {{ __('general.Update') }} {{ __('app.Member') }}</a><br>
        </div>
    </div>
    <div class="col-md-9">
        <div class="">
            @include('members.partials.search')
        </div>
        <form class="form-horizontal" method="POST" action="" id="sell_form" accept-charset="UTF-8" >
            {{ csrf_field() }}
            <div class="row mb-3">
                <div class="col-md-6">
                    <button class="btn btn-warning" type="submit"><i class="fa fa-shopping-cart"></i> {{ __('app.Sell_finish') }}</button> 
                    
                    <button id="credit_finish" class="btn btn-info" type="button"><i class="fa fa-shopping-cart"></i> {{ __('app.Sell_finish_credit') }}</button> 

                    <button class="btn btn-danger" type="button" id="sell_reset"><i class="fa fa-history"></i> {{ __('app.Sell_reset') }}</button>
                </div>
                <div class="col-md-6">
                    <h3 class="sectionHeader text-left mb-0">
                        {{ __('app.Sell_total') }}: 
                        {{-- <span id="total_amount">0</span>gr. -  --}}
                        <span id="total_price">0</span>{{  __('app.Coin') }}
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            @php 
                $section = '';
            @endphp

            @foreach ($products as $product)
                @if ($product->category !== $section)
                    @php $class_row = 'border border-left-0 border-bottom-0  border-right-0 border-dark';@endphp
                @else
                    @php 
                        $class_row = '';
                    @endphp
                @endif
                @php 
                    $section = $product->category;
                @endphp
                <div class="row resumeFont {{ $class_row }} @php echo ($product->bar == 1 ? 'bg-secondary text-white' : '')@endphp pt-1 pb-0">
                    <div class="col-md-4 text-right">
                        @if($product->bar == 0)
                        <small class="text-primary">
                            {{ $product->category }} - {{ $product->price }} {{  __('app.Coin') }}
                            /{{ strtolower(__('app.Gram')) }}
                        </small> 
                        @else
                        <small class="text-white">
                            {{ $product->price }} {{  __('app.Coin') }}
                        </small> 
                        @endif
                        <span class="resumeFontMedium">{{ $product->name }}</span>
                    </div>
                    <div class="col-md-1 text-right">
                        <label for="prod{{ $product->id }}">{{ __('app.Amount') }}:</label>
                    </div>
                    <div class="col-md-2" mb-1>
                        <input type="text" name="prod{{ $product->id }}" id="prod{{ $product->id }}" value="0" class="numeric text-right form-control-sm form-control amount" data-id="{{ $product->id }}" data-price="{{ $product->price }}" placeholder="gr." />
                    </div>

                    <div class="col-md-1 text-right">
                        <label for="prod{{ $product->id }}">{{ __('app.Cost') }}:</label>
                    </div>
                    <div class="col-md-2 mb-1">
                        <input type="text" name="money{{ $product->id }}" id="money{{ $product->id }}" value="0" class="numeric text-right form-control-sm form-control money" data-id="{{ $product->id }}" data-price="{{ $product->price }}" placeholder="Euros" />
                    </div>
                </div>
            @endforeach
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
@endsection

@section('js')
<script type="text/javascript" src="{{ url('js/jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/counter.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/sell.js') }}"></script>
<script type="text/javascript" src="{{ url('js/search.js') }}"></script>
<script type="text/javascript" src="{{ url('js/credit.js') }}"></script>
@endsection
