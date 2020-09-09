<?php
$size = (!isset($size) ? 'input-group-lg' : $size);
?>
<form role="form" data-sell="{{ route('sell') }}" action="{{ route('members.search') }}" method="get" class="form-media" name="search_member" id="search_member">
    {{ csrf_field() }}
    <div class="input-group {{ $size }} mb-3">
        <label class="sr-only" for="search_member_value">{{ __('app.Search_member') }}</label>
        <input type="text" class="form-control" id="search_member_value" name="search_member_value" placeholder="{{ __('app.Search_member') }}" value="">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary" class="btnstyle btn-success" title="{{ __('app.Search_member') }}"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pb-1 pt-1">
                <h3 class="modal-title" id="petitionCandidatesModalLabel">{{ __('general.Search') }} {{ __('app.Members') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="modal-body" id="searchModalBody"></div>
            </div>
        </div>
    </div>
</div>