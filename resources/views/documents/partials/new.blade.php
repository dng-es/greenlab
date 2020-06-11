<div class="card border-0">
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('member.document.new', ['member' => $member->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>
                        <label for="name" class="control-label">{{ __('general.Name') }}</label>
                        <input id="name" @error('name') is-invalid @enderror type="text" class="form-control " name="name" value="" required list="NamesList">
                        
                        @error('name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <datalist id="NamesList">
                        <option value="{{ __('app.Vat') }}">
                        <option value="{{ __('app.Acept_condicitions') }}">
                    </datalist>
                </div>
                <div class="col-md-7">
                    <div class="form-group" {{ $errors->has('file') ? ' has-error' : '' }}>
                        <label for="logo" class="control-label">File <small>(pdf, jpg, png, gif)</small></label>
                        <input @error('file') is-invalid @enderror type="file" id="file" name="file" data-text='<i class="fa fa-search"></i> {{ __('general.ChooseFile') }}' class="filestyle btn-block" aria-describedby="file">

                        @error('file')
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
                        <button type="submit" class="btn btn-warning"><i class="fa fa-upload"></i> {{ __('general.ImportFile') }}</button> 
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>