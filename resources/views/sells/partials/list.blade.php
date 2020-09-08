@php 
    $section = '';
    $class_row = 'success';
@endphp

@foreach ($products as $product)
    @if ($product->category !== $section)
        @php $class_row = ($class_row == 'success primary2' ? 'success' : 'success primary2');@endphp
    @endif
    @php 
        $section = $product->category;
    @endphp
    @include('sells.partials.item', ['product' => $product, 'class_row' => $class_row])
@endforeach