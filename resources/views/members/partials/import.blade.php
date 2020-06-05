<!-- Modal -->
<div class="modal fade" id="membersImportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('app.Members_import') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="POST" action="{{ route('members.import') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <p class="text-danger text-center">
                        <b>XLSX</b> file and must have columns:<br>
                        [code], [vat], [name], [last_name]
                    </p>          

                    <div class="form-group{{ $errors->has('filename') ? ' has-error' : '' }}">
                        <label for="filename" class="control-label">{{ __('general.File') }}</label>
                        <input type="file" id="filename" name="filename" data-text="{{ __('general.ChooseFile') }}" class="filestyle btn-block" id="image" aria-describedby="file" accept="xlsx" @error('filename') is-invalid @enderror >
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-lg btn-block">
                            <i class="fa fa-save text-white"></i> {{ __('general.ImportFile') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>