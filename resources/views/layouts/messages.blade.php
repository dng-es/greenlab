@if (session('status'))
	@switch(session('status_mode'))
		@case('success')
		    <div class="alert-app alert alert-success alert-dismissible fade show" role="alert">
		        <i class="fas fa-check"></i> <span id="alert-msg">{{ session('status') }}</span>
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		@break

		@case('error')
		    <div class="alert-app alert alert-danger alert-dismissible fade show" role="alert">
		        <i class="fas fa-exclamation-triangle"></i> <span id="alert-msg">{{ session('status') }}</span>
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		@break

		@default
		
		    <div class="alert-app alert alert-info alert-dismissible fade show" role="alert">
		        <i class="fas fa-info"></i> <span id="alert-msg">{{ session('status') }}</span>
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
	@endswitch
@endif