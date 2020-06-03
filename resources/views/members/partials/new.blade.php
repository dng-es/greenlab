<div id="member-message" class="alert" role="alert" style="display:none"></div>
<form class="form-horizontal" method="POST" action="{{ route('member.create') }}" id="new_member"  accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col md-6">
            <!-- Stream video via webcam -->
            <div class="video-wrap">
                <video width="320" id="video" playsinline autoplay></video>
            </div>

            <!-- Trigger canvas web API -->
            <div class="controller">
                <button type="button" class="btn btn-secondary" id="snapNew"><i class="fa fa-camera-retro"></i> {{ __('general.NewCapture') }}</button>

                <button type="button" class="btn btn-danger" id="snap"><i class="fa fa-camera-retro"></i> {{ __('general.Capture') }}</button>
            </div>

            <span id="errorMsg" class="text-danger"></span>
            <!-- Webcam video snapshot -->
            <canvas id="canvas" style="position:absolute; top:0"></canvas>
            <canvas id='canvas_blank' style='display:none'></canvas>

        </div>
        <div class="col md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="control-label">Code</label>
                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}">
                    </div>            
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }}">
                        <label for="vat" class="control-label">{{ __('app.Vat')}}</label>
                        <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}">
                    </div>            
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">{{ __('general.Name')}}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                    </div>            
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="control-label">{{ __('general.Last_name')}}</label>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">{{ __('general.Email')}}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>  
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                        <label for="telephone" class="control-label">{{ __('general.Telephone')}}</label>
                        <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required>
                        @error('telephone')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('born_at') ? ' has-error' : '' }}">
                        <label for="born_at" class="control-label spice">{{ __('general.Born_at')}}</label>
                        <input id="born_at" type="text" class="date-only form-control" name="born_at" value="{{ old('born_at', Carbon\Carbon::now()->addYears(-18)->format('Y-m-d')) }}">
                        @error('born_at')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>        
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                        <label for="notes" class="control-label">{{ __('general.Notes')}}</label>
                        <textarea id="notes" type="text" class="form-control" data-alert="Campo requerido" name="notes">{{ old('notes') }}</textarea>
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
                    <div class="chiller_cb mt-3 mb-2">
                        <input type="checkbox" value="1" name="active" checked id="active">
                        <label for="active">{{ __('general.Active')}}</label>
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">            
                    <div class="form-group new-member">
                        <button type="submit" class="btn btn-warning btn-lg btn-block">
                            <i class="fa fa-save text-white"></i> {{ __('app.New_member') }}
                        </button>
                    </div>

                    <div class="form-group edit-member" style="display:none">
                        <input type="hidden" name="member_id" id="member_id" value="0" />
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fa fa-save text-white"></i> {{ __('general.Update') }}
                        </button>

                        <a href="{{ route('sell') }}" id="sellBtn" class="btn btn-warning btn-lg btn-block">
                            <i class="fa fa-cart-plus text-white"></i> {{ __('app.Sell_new') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>