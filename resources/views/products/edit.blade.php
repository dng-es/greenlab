@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('product_edit', $product) }}

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
                        <select id="category_id" class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @php echo ($product->category_id == $category->id ? ' selected="selected" ' : '');@endphp>{{ $category->name }}</option>
                        @endforeach
                        </select>
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
    </div>
    <div class="col-md-6">
        <h3 class="sectionHeader">{{ __('app.Entry_new') }}</h3>
        @include('warehouses.partials.new', ['product' => $product])
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('js/warehouse.js') }}"></script>
@endsection