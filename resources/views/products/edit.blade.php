@extends('layouts.appadmin')

@section('content_admin')
@if ($bar == 1)
{{ Breadcrumbs::render('product_bar_edit', $product) }}
@else
{{ Breadcrumbs::render('product_edit', $product) }}
@endif

@include('layouts.messages')     

<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal" method="POST" action="">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label">{{ __('general.Name')}}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="control-label">{{ __('app.Category')}}</label>
                        <div class="input-group mb-3 my-group">
                            <select id="category_id" class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @php echo ($product->category_id == $category->id ? ' selected="selected" ' : '');@endphp>{{ $category->name }}</option>
                            @endforeach
                            </select>
                             <span class="input-group-append">
                                <a class="btn btn-info" href="{{ route('category.new', ['bar' => $bar]) }}" title="{{ __('general.New'). ' '.__('app.Category') }}"><i class="fa fa-plus-circle text-white"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price" class="control-label">{{ __('app.Price')}}</label>
                        <input id="price" type="number" step="any" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ number_format($product->price, 2, '.', ',') }}" required >
                        @error('price')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount" class="control-label">{{ __('app.Amount')}}</label>
                        <input id="amount" type="number" step="any" disabled class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ number_format($product->amount, 2, '.', ',') }}" required >
                        @error('amount')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div> 
            </div>

            <div class="chiller_cb mt-3 mb-2">
                <input type="checkbox" value="1" name="menu" {{ $product->menu == 1 ? 'checked' : '' }} id="menu">
                <label for="menu">{{ __('app.Menu')}}</label>
                <span></span>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @php
        $sells_amount = $product->warehouses()->where('type', 'S')->sum('amount_real');
        $sells_total = $product->warehouses()->where('type', 'S')->sum('total');
        $expenses_amount = $product->warehouses()->where('type', 'E')->sum('amount');
        $expenses_total = $product->warehouses()->where('type', 'E')->sum('total');
        $total = $sells_total - $expenses_total;
        $percentage = (($total / $expenses_total) * 100);
        @endphp

        <div class="table-responsive mt-3">
            <table class="table">
                <tr>
                    <td>{{ __('app.Sells') }}</td>
                    @if ($bar == 0)
                    <td class="text-right">
                        {{ number_format($sells_amount, 2, '.', ',') }}<small>{{ __('app.Grams') }}</small>
                    </td>
                    @endif
                    <td class="text-right">
                            {{ number_format($sells_total, 2, '.', ',') }}<small>{{ __('app.Coin') }}</small>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('app.Expenses') }}</td>
                    @if ($bar == 0)
                    <td class="text-right">
                    {{ number_format($expenses_amount, 2, '.', ',') }}<small>{{ __('app.Grams') }}</small>
                    </td>
                    @endif
                    <td class="text-right">
                    {{ number_format($expenses_total, 2, '.', ',') }}<small>{{ __('app.Coin') }}</small>
                    </td>
                </tr>
                <tfoot class="font-weight-bold">
                    <td>{{ __('app.Total') }} ({{ number_format($percentage, 2, '.', ',') }}%)</td>

                    @if ($bar == 0)
                    <td class="text-right">
                    {{ number_format($product->amount, 2, '.', ',') }}<small>{{ __('app.Grams') }}</small>
                    </td>
                    @endif
                    <td class="text-right">
                    {{ number_format($total, 2, '.', ',') }}<small>{{ __('app.Coin') }}</small>
                    </td>
                </tfoot>
            </table>
        </div> 
    </div>
    <div class="col-md-6">
        @include('warehouses.partials.new', ['product' => $product])
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('js/warehouse.js') }}"></script>
@endsection