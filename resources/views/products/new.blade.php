@extends('layouts.appadmin')

@section('content_admin')
@if ($bar == 1)
{{ Breadcrumbs::render('product_bar_new') }}
@else
{{ Breadcrumbs::render('product_new') }}
@endif

@include('layouts.messages')       

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 mb-3">
            <div class="card-body pb-0">
                <form class="form-horizontal" method="POST" action="">
                    {{ csrf_field() }}            

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('general.Name')}}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
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
                                    <select id="category_id" class="form-control selectpicker show-tick" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @php echo (old('category_id') == $category->id ? ' selected="selected" ' : '');@endphp>{{ $category->name }}</option>
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
                                <label for="price" class="control-label">
                                    {{ __('app.Price')}}
                                    <small>
                                        {{  __('app.Coin') }}/
                                        @if($bar == 0)
                                            {{ strtolower(__('app.Gram')) }}
                                        @else
                                            {{ strtolower(__('app.Unit')) }}
                                        @endif
                                    </small>
                                </label>
                                <input id="price" type="number" step="any"  class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amoount" class="control-label">{{ __('app.Amount')}}</label>
                                <input id="amoount" type="number" step="any"  disabled class="form-control @error('amoount') is-invalid @enderror" name="amoount" value="{{ old('amoount') }}" required>
                                @error('amoount')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="chiller_cb mt-3 mb-2">
                        <input type="checkbox" value="1" name="menu" id="menu">
                        <label for="menu">{{ __('app.Menu')}}</label>
                        <span></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
