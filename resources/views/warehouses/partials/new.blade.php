@php
$bar = (isset($bar) ? $bar : -1);
$type = (isset($type) ? $type : 'E');
@endphp
@if($type == 'E')
<h3 class="sectionHeader">{{ __('app.Movements_in_new') }}</h3>
@else
<h3 class="sectionHeader">{{ __('app.Movements_out_new') }}</h3>
@endif
<form class="form-horizontal" method="POST" action="{{ route('warehouse.new') }}">
    {{ csrf_field() }}            
    <input type="hidden" name="type" id="type" value="{{ $type}}" />

    @if (isset($product))
        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" />
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                <label for="product_id" class="control-label">{{ __('app.Product')}}</label>
                <div class="input-group mb-3 my-group">
                    <select id="product_id" class="form-control selectpicker" name="product_id">
                    @foreach($products as $element)
                        @if($bar == $element->bar || $bar == -1)
                        <option data-subtext="{{ $element->category()->first()->name }}" value="{{ $element->id }}" @php echo (old('product_id') == $element->id ? ' selected="selected" ' : '');@endphp>{{ $element->name }}</option>
                        @endif
                    @endforeach
                    </select>
                    <span class="input-group-append">
                        <a class="btn btn-info" href="{{ route('product.new') }}" title="{{ __('general.New'). ' '.__('app.Product') }}"><i class="fa fa-plus-circle text-white"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                <label for="supplier_id" class="control-label">{{ __('app.Supplier')}}</label>
                <div class="input-group mb-3 my-group">
                    <select id="supplier_id" class="form-control selectpicker" name="supplier_id">
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @php echo (old('supplier_id') == $supplier->id ? ' selected="selected" ' : '');@endphp>{{ $supplier->name }}</option>
                    @endforeach
                    </select>
                    <span class="input-group-append">
                        <a class="btn btn-info" href="{{ route('supplier.new') }}" title="{{ __('general.New'). ' '.__('app.Supplier') }}"><i class="fa fa-plus-circle text-white"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="amount_sell" class="control-label">
                    {{ __('app.Amount')}}
                    @if($bar == 0)
                    <small>{{ strtolower(__('app.Grams')) }}</small>
                    @else
                    <small>{{ strtolower(__('app.Unit')) }}</small>
                    @endif
                </label>
                <input id="amount_sell" type="number" step="any" class="border-0 bg-light text-right form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>
                @error('amount')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="amount_real" class="control-label">
                    {{ __('app.Amount')}} real 
                    @if($bar == 0)
                    <small>{{ strtolower(__('app.Grams')) }}</small>
                    @else
                    <small>{{ strtolower(__('app.Unit')) }}</small>
                    @endif
                </label>
                <input id="amount_real" type="number" step="any" class="border-0 bg-light text-right form-control @error('amount_real') is-invalid @enderror" name="amount_real" value="{{ old('amount_real') }}" required>
                @error('amount_real')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="price_sell" class="control-label">
                    {{ __('app.Price')}} <small>{{  __('app.Coin') }}</small>
                </label>
                <input id="price_sell" type="number" step="any"  class="border-0 bg-light text-right form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="total" class="control-label">{{ __('app.Total')}} <small>{{  __('app.Coin') }}</small></label>
                <input id="total" type="number" step="any" class="border-0 bg-light text-right form-control @error('amount_real') is-invalid @enderror" name="total" value="{{ old('total') }}" required>
                @error('total')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="#" class="text-info notes-up"><i class="fa fa-plus-circle"></i></a> <label for="notes" class="control-label">{{ __('general.Notes')}}</label>
                <div style="display:none" class="notes-down">
                    <textarea rows="3" id="notes" class="border-0 bg-light form-control @error('notes') is-invalid @enderror" name="notes">
                        {{ old('notes') }}
                    </textarea>
                </div>
                @error('notes')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg">
                    <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                </button>
            </div>
        </div>
    </div>
</form>