<div id="credits-message" class="alert" role="alert" style="display:none"></div>
<form class="form-horizontal" method="POST" action="{{ route('credits.create') }}" id="new_credit"  accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="member_id" id="member_id" value="{{ $member->id }}" />

    <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
        <label for="credit" class="control-label">{{ __('general.New') }} {{ __('app.Credit') }}:</label>
        <input id="credit" type="number" class="text-right form-control @error('credit') is-invalid @enderror" name="credit" value="{{ old('credit') }}" placeholder="{{  __('app.Coin') }}" required autofocus >
    </div>    

    <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
        <label for="notes" class="control-label">{{ __('general.Notes') }}:</label>
        <textarea id="notes" class="text-right form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>
    </div>    


    <div class="form-group">
        <button type="submit" class="btn btn-info btn-lg btn-block">
            <i class="fa fa-plus-circle text-white"></i> {{ __('app.Credit_add') }}
        </button>
    </div>
</form>