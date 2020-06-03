<div id="fees-message" class="alert" role="alert" style="display:none"></div>
<form class="form-horizontal" method="POST" action="{{ route('fees.create') }}" id="new_fee"  accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="member_id" id="fees_member_id" value="{{ $member->id }}" />

    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="control-label">{{ __('app.Price') }}:</label>
        <input id="price" type="number" class="text-right form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="{{  __('app.Coin') }}" required autofocus>
    </div>

    <div class="form-group{{ $errors->has('init_at') ? ' has-error' : '' }}">
        <label for="init_at" class="control-label spice">{{ __('general.Date_ini')}}</label>
        <input id="init_at" required type="text" class="date-only form-control" name="init_at" value="{{ $member->init_at }}">
        @error('init_at')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
        <label for="end_at" class="control-label spice">{{ __('general.Date_end')}}</label>
        <input id="end_at" required type="text" class="date-only form-control" name="end_at" value="{{ $member->end_at }}">
        @error('end_at')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>    

    <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
        <label for="notes" class="control-label">{{ __('general.Notes') }}:</label>
        <textarea id="notes" class="text-right form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>
    </div>    


    <div class="form-group">
        <button type="submit" class="btn btn-info btn-lg btn-block">
            <i class="fa fa-plus-circle text-white"></i> {{ __('general.SaveData') }}
        </button>
    </div>
</form>