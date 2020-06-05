<div class="row resumeFont {{ $class_row }} pt-1 pb-0 rounded mt-1 mb-1">
    <div class="col-md-4 text-right">
        <small>
        @if($product->bar == 0)
            {{ $product->category }} - {{ $product->price }} {{  __('app.Coin') }}
            /{{ strtolower(__('app.Gram')) }}
        @else
            {{ $product->category }} - {{ $product->price }} {{  __('app.Coin') }}
        @endif
        </small> 
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