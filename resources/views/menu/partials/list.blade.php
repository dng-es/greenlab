<div class="container">
    <div class="row">
        @foreach($categories->chunk(2) as $elements) 
            <div class="col-md-6 text-center mt-4">     
            @foreach($elements as $category) 
                @if($category->productsActive()->count() > 0)
                    <h4 class="sectionHeader preview-title mt-5 mb-0" style="font-size:{{ ($menu->fontsize + 10) }}px; color:{{ $menu->fontcolor }}">
                        {{ $category->name }}
                    </h4>
                    @foreach($category->productsActive()->orderBy('price')->orderBy('name')->get() as $product) 
                        <p class="resumeFont preview mb-0 mt-0" style="font-size:{{ $menu->fontsize }}px; color:{{ $menu->fontcolor }}">
                            {{ $product->name }} .............. {{ $product->price }} <small>€/gr</small>
                        </p>        
                    @endforeach
                @endif
            @endforeach
            </div>
        @endforeach
    </div>
</div>