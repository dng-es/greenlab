@extends('layouts.appadmin')

@section('content_admin')
{{ Breadcrumbs::render('supplier_edit', $supplier) }}

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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $supplier->name }}" required autofocus>
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
                                <label for="notes" class="control-label">{{ __('general.Notes')}}</label>
                                <textarea rows="5" id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ $supplier->notes }}</textarea>
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
        <h3 class="sectionHeader text-center">{{ __('general.History') }}</h3>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-sm resumeFont">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ __('app.Product') }}</th>
                        <th class="text-right">{{ __('app.Price') }}</th>
                        <th class="text-right">{{ __('app.Amount') }}</th>
                        <th class="text-right">{{ __('app.Amount') }} real</th>
                        <th class="text-right">{{ __('app.Cost') }}</th>
                        <th>{{ __('general.Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warehouses as $element)
                    <tr>
                        <td>
                            <b>{{ $element->product }}</b> <em>{{ $element->category }}</em>
                        </td>
                        <td class="text-right">{{ $element->price }} {{  __('app.Coin') }}</td>
                        <td class="text-right">
                            {{ $element->amount }} 
                            @if($element->bar == 0)
                            <small>{{ strtolower( __('app.Grams')) }}</small>
                            @endif
                        </td>
                        <td class="text-right">
                            {{ $element->amount_real }} 
                            @if($element->bar == 0)
                            <small>{{ strtolower( __('app.Grams')) }}</small>
                            @endif
                        </td>
                        <td class="text-right">{{ ($element->total) }} {{  __('app.Coin') }}</td>
                        <td><small>{{ $element->created_at }}</small></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $warehouses->links() }}
        </div>        
    </div>
</div>
@endsection
