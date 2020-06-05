@php 
    $section = '';
    $class_row = 'bg-success';
@endphp

@foreach ($products as $product)
    @if ($product->category !== $section)
        @php $class_row = ($class_row == 'bg-dark text-white' ? 'bg-success' : 'bg-dark text-white');@endphp
    @endif
    @php 
        $section = $product->category;
    @endphp
    @include('sells.partials.item', ['product' => $product, 'class_row' => $class_row])
@endforeach