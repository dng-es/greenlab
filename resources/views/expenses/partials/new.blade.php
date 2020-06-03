<form class="form-horizontal" method="POST" action="{{ route('expenses.new') }}">
    {{ csrf_field() }}            

    <div class="row">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('date_at') ? ' has-error' : '' }}">
                <label for="date_at" class="control-label spice">{{ __('general.Date')}}</label>
                <input id="date_at" required type="text" class="date-only form-control" name="date_at" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                @error('date_at')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                <label for="supplier_id" class="control-label">{{ __('app.Supplier')}}</label>
                <select id="supplier_id" class="form-control" name="supplier_id">
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @php echo (old('supplier_id') == $supplier->id ? ' selected="selected" ' : '');@endphp>{{ $supplier->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                <label class="control-label">&nbsp;</label><br>
                <a class="btn btn-info btn-sm" href="{{ route('supplier.new') }}" title="{{ __('general.New'). ' '.__('app.Supplier') }}"><i class="fa fa-plus-circle text-white"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="amount" class="control-label">
                    {{ __('app.Amount')}}
                </label>
                <input id="amount" type="number" step="any" class="text-right form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>
                @error('amount')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="price" class="control-label">
                    {{ __('app.Price')}} <small>{{  __('app.Coin') }}</small>
                </label>
                <input id="price" type="number" step="any"  class="text-right form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="total" class="control-label">{{ __('app.Total')}}</label>
                <input id="total" type="number" step="any" class="text-right form-control @error('amount_real') is-invalid @enderror" name="total" value="{{ old('total') }}" required>
                @error('total')
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
                <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">
                    {{ old('notes') }}
                </textarea>
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