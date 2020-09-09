@foreach ($products as $product)
    @include('sells.partials.item', ['product' => $product])
@endforeach