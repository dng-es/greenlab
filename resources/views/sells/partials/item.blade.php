<div class="row resumeFont {{ $class_row }} pt-1 pb-0 rounded mt-1 mb-1">
    <div class="col-md-4 text-right">
        <small>
        @if($product->bar == 0)
            @php $label_amount = strtolower(__('app.Grams'));@endphp
            {{ $product->category }} - {{ $product->price }} {{  __('app.Coin') }}
            /{{ strtolower(__('app.Gram')) }}
        @else
            @php $label_amount = strtolower(__('app.Unit'));@endphp
            {{ $product->category }} - {{ $product->price }} {{  __('app.Coin') }}
        @endif
        </small> 
        <span class="resumeFontMedium">{{ $product->name }}</span>
    </div>
    <div class="col-md-1 text-right">
        <label for="prod{{ $product->id }}">{{ __('app.Amount') }}:</label>
    </div>
    <div class="col-md-2" mb-1>
        <input type="text" name="prod{{ $product->id }}" id="prod{{ $product->id }}" value="" class="numeric text-right form-control-sm form-control amount" data-id="{{ $product->id }}" data-price="{{ $product->price }}" placeholder="{{ $label_amount }}" list="amountList{{ $product->id }}" />
        <datalist id="amountList{{ $product->id }}">
            <option value="1">
            <option value="2">
            <option value="3">
            <option value="4">
            <option value="5">
        </datalist>
    </div>

    <div class="col-md-1 text-right">
        <label for="prod{{ $product->id }}">{{ __('app.Cost') }}:</label>
    </div>
    <div class="col-md-2 mb-1">
        <input type="text" name="money{{ $product->id }}" id="money{{ $product->id }}" value="" class="numeric text-right form-control-sm form-control money" data-id="{{ $product->id }}" data-price="{{ $product->price }}" placeholder="{{ __('app.Coin') }}" list="priceList{{ $product->id }}" />
        <datalist id="priceList{{ $product->id }}">
            <option value="5">
            <option value="10">
            <option value="15">
            <option value="20">
            <option value="25">
            <option value="30">
        </datalist>
    </div>
</div>