<div class="row resumeFont pt-0 pb-0 rounded mt-0 mb-0 border-bottom">
    <div class="col-md-6">
        <span class="resumeFontMedium">{{ $product->name }}</span><br>
        <span class="badge badge text-white" style="background-color: {{ $product->color }}">{{ $product->category }}</span>
        <span class="badge badge-secondary">
        @if($product->bar == 0)
            @php $label_amount = strtolower(__('app.Grams'));@endphp
            {{ $product->price }} {{  __('app.Coin') }}/{{ strtolower(__('app.Gram')) }}
        @else
            @php $label_amount = strtolower(__('app.Unit'));@endphp
            {{ $product->price }} {{  __('app.Coin') }}
        @endif
        </span>
    </div>
    <div class="col-md-3 mb-1">
        <label class="mb-0" for="prod{{ $product->id }}"><small>{{ __('app.Amount') }}:</small></label><br>
        <input type="text" name="prod{{ $product->id }}" id="prod{{ $product->id }}" value="" class="mb-1 numeric text-right form-control-sm form-control amount" data-id="{{ $product->id }}" data-price="{{ $product->price }}" placeholder="{{ $label_amount }}" list="amountList{{ $product->id }}" />
        <datalist id="amountList{{ $product->id }}">
            <option value="1">
            <option value="2">
            <option value="3">
            <option value="4">
            <option value="5">
        </datalist>
    </div>


    <div class="col-md-3 mb-1">
        <label class="mb-0" for="prod{{ $product->id }}"><small>{{ __('app.Cost') }}:</small></label><br>
        <div class="input-group my-group input-group-sm mb-1">
            <input type="text" name="money{{ $product->id }}" id="money{{ $product->id }}" value="" class="numeric text-right form-control-sm form-control money" data-id="{{ $product->id }}" data-price="{{ $product->price }}" placeholder="{{ __('app.Coin') }}" list="priceList{{ $product->id }}" />
            <datalist id="priceList{{ $product->id }}">
                <option value="5">
                <option value="10">
                <option value="15">
                <option value="20">
                <option value="25">
                <option value="30">
            </datalist>
            <span class="input-group-append">
                <a class="btn btn-outline-danger btn-remove" href="#" data-id="{{ $product->id }}" title="{{ __('general.Delete') }}"><i class="fa fa-times"></i></a>
            </span>
        </div>
    </div>
</div>