@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('member_edit', $member) }}

@include('layouts.messages')

<div class="row">
    <div class="col-md-3">
        <div class="text-center" style="position:relative">            
            <img src="{{ $member->imageProfile() }}" width="320px" height="240px" class="mb-3" />
            <h3 class="sectionHeader">{{ $member->name }} {{ $member->last_name }}</h3>
            <h5 class="resumeFont"><small>{{ __('app.This_month') }}</small> <b>{{ $total_month }} {{ strtolower( __('app.Grams')) }}</b></h5>
            

             <!-- Stream video via webcam -->
            <div class="video-wrap" style="position: absolute; top: 0px; left:3px; display: none">
                <video width="320" id="video" playsinline autoplay></video>
            </div>

            <!-- Trigger canvas web API -->
            <div class="controller">
                <button type="button" class="btn btn-secondary" id="snapNew"><i class="fa fa-camera-retro"></i> {{ __('general.NewCapture') }}</button>

                <button type="button" class="btn btn-danger" id="snap"><i class="fa fa-camera-retro"></i> {{ __('general.Capture') }}</button>
            </div>

            <span id="errorMsg" class="text-danger"></span>
            <!-- Webcam video snapshot -->
            <canvas id="canvas" style="position:absolute; top:0px; left: 3px"></canvas>
            <canvas id='canvas_blank' style='display:none'></canvas>

            <br><a href="{{ route('sell', ['member' => $member]) }}" class="btn btn-lg btn-success"><i class="fa fa-cart-plus"></i> {{ __('app.Sell_new') }}</a>
                                    
            @include('credits.partials.btn', ['member' => $member])
        </div>
    </div>
    <div class="col-md-9">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ __('app.Personal_information') }}</a>
                <a class="nav-item nav-link" id="nav-warehouses-tab" data-toggle="tab" href="#nav-warehouses" role="tab" aria-controls="nav-warehouses" aria-selected="false">{{ __('app.Sells') }}</a>
                <a class="nav-item nav-link" id="nav-credits-tab" data-toggle="tab" href="#nav-credits" role="tab" aria-controls="nav-credits" aria-selected="false">{{ __('app.Credits') }}</a>
                <a class="nav-item nav-link" id="nav-cuotes-tab" data-toggle="tab" href="#nav-cuotes" role="tab" aria-controls="nav-cuotes" aria-selected="false">{{ __('app.Fees') }}</a>
                
            </div>
        </nav>

        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div id="member-message" class="alert" role="alert" style="display:none"></div>
                <form class="form-horizontal" id="new_member" method="POST" action="{{ route('members.update', ['member' => $member->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="member_id" id="member_id" value="{{ $member->id }}" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="code" class="control-label">Code</label>
                                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $member->code }}" required autofocus>
                                        @error('code')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="control-label">{{ __('general.Name')}}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $member->name }}" required autofocus>
                                        @error('name')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>      
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">{{ __('general.Last_name')}}</label>
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $member->last_name }}" required autofocus>
                                        @error('last_name')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col md-4">
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                        <label for="telephone" class="control-label">{{ __('general.Telephone')}}</label>
                                        <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ $member->telephone }}" required>
                                        @error('telephone')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>  
                                </div>
                                <div class="col md-4">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="control-label">{{ __('general.Email')}}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $member->email }}" required>
                                        @error('email')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>  
                                </div>
                                <div class="col md-4">
                                    <div class="form-group{{ $errors->has('born_at') ? ' has-error' : '' }}">
                                        <label for="born_at" class="control-label spice">{{ __('general.Born_at')}}</label>
                                        <input id="born_at" type="text" class="date-only form-control" name="born_at" value="{{ $member->born_at }}">
                                        @error('born_at')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>        
                            </div>

                            <div class="row">
                                <div class="col md-12">
                                    <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                                        <label for="notes" class="control-label">{{ __('general.Notes')}}</label>
                                        <textarea id="notes" rows="5" type="text" class="form-control" data-alert="Campo requerido" name="notes">{{ $member->notes }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>         
                                </div>
                            </div>

                            <div class="row">
                                <div class="col md-12">
                                    <div class="chiller_cb mb-4">
                                        <input type="checkbox" value="1" name="active" {{ $member->active == 1 ? 'checked' : '' }} id="active">
                                        <label for="active">{{ __('general.Active')}}</label>
                                        <span></span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-warning">
                                            <i class="fa fa-save text-white"></i> {{ __('general.SaveData')}}
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="nav-warehouses" role="tabpanel" aria-labelledby="nav-warehouses-tab">

                <div class="fa-3x loading_warehouses mt-5 text-center text-muted">
                    <i class="fas fa-spinner fa-pulse"></i>
                </div>
                <div id="warehouses" data-pourl="{{ route('members.warehouses', ['member' => $member]) }}"></div>
            </div>

           <div class="tab-pane fade" id="nav-credits" role="tabpanel" aria-labelledby="nav-credits-tab">
                <div class="fa-3x loading_credits mt-5 text-center text-muted">
                    <i class="fas fa-spinner fa-pulse"></i>
                </div>
                <div id="credits" data-pourl="{{ route('members.credits', ['member' => $member]) }}"></div>
            </div>

           <div class="tab-pane fade" id="nav-cuotes" role="tabpanel" aria-labelledby="nav-cuotes-tab">
        Cuotas
            </div>
        </div>        
    </div>
</div>

<!-- Credit Modal -->
<div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('app.Credit') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('credits.partials.new', ['member' => $member])
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webcam.js') }}"></script>
<script type="text/javascript" src="{{ url('js/member.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/counter.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/credit.js') }}"></script>
<script type="text/javascript" src="{{ url('js/warehouses.js') }}"></script>
<script type="text/javascript" src="{{ url('js/credits.js') }}"></script>
@endsection