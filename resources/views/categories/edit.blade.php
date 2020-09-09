@extends('layouts.appadmin')

@section('content_admin')
@if ($category->bar == 1)
{{ Breadcrumbs::render('bar_edit', $category) }}
@else
{{ Breadcrumbs::render('category_edit', $category) }}
@endif

@section('css')
<link href="{{ url('vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
@endsection

@include('layouts.messages')      
<div class="row">
    <div class="col-md-4">
        <div class="card border-0 mb-3">
            <div class="card-body pb-0">
                <form class="form-horizontal" method="POST" action="">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('general.Name')}}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required autofocus>
                                @error('name')
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
                                <label for="color" class="control-label">{{ __('general.Color')}}</label>
                                <div id="cp1" class="input-group" title="Color de la categoría">
                                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $category->color }}" required>
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                @error('color')
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
                                <label for="notes" class="control-label">{{ __('general.Notes')}}</label>
                                <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ $category->notes }}</textarea>
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

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-sm resumeFont">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.Product') }}</th>
                        <th class="text-right">{{ __('app.Price') }}</th>
                        <th class="text-right">{{ __('app.Amount') }}</th>
                        <th class="text-center">{{ __('app.Menu') }}</th>
                    </tr>   
                </thead>
                <tbody>
                    @foreach ($products as $element)
                    <tr>
                        <td>
                            <a title="{{ __('general.Edit') }}" href="{{ route('product.edit', ['product' => $element->id, 'bar' => $category->bar]) }}">{{ $element->name }}</a> <small><em class="text-muted">{{ $element->category->name }}</em></small>
                        </td>
                        <td class="text-right">{{ number_format($element->price, 2, '.', ',') }} {{  __('app.Coin') }}</td>
                        <td class="text-right">
                            {{ number_format($element->amount, 2, '.', ',') }} 
                            @if($category->bar == 0)
                            <small><em class="text-muted">{{ strtolower(__('app.Grams')) }}</em></small>
                            @else
                            <small><em class="text-muted">{{ strtolower(__('app.Unit')) }}</em></small>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($element->menu == 1)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/category.js') }}"></script>
@endsection