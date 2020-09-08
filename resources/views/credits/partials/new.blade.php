<div id="credits-message" class="alert" role="alert" style="display:none"></div>
<form class="form-horizontal" method="POST" action="{{ route('credits.create') }}" id="new_credit"  accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="member_id" id="member_id" value="{{ $member->id }}" />

    <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
        <label for="credit" class="control-label">{{ __('app.Cost') }}:</label>
        <input id="credit" type="number" step="0.01" class="border-0 bg-light text-right form-control @error('credit') is-invalid @enderror" list="creditList" name="credit" value="{{ old('credit') }}" placeholder="{{  __('app.Coin') }}" required autofocus >
        <datalist id="creditList">
            <option value="5">
            <option value="10">
            <option value="15">
            <option value="20">
            <option value="25">
            <option value="30">
        </datalist>
    </div>    

    <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
        <a href="#" class="text-info notes-up"><i class="fa fa-plus-circle"></i></a> <label for="notes" class="control-label">{{ __('general.Notes') }}:</label>
        <div style="display:none" class="notes-down">
            <textarea id="credit_notes" class="border-0 bg-light form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>
        </div>
    </div>    


    <div class="form-group">
        <button type="submit" class="btn btn-info btn-lg btn-block">
            <i class="fa fa-plus-circle text-white"></i> {{ __('app.Credit_add') }}
        </button>
    </div>
</form>