@extends('layouts.appadmin')

@section('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('dashboard') }}

@include('layouts.messages')
@if($update_app)
<div class="alert alert-warning">Actualización disponible</div>
@endif
<div class="">
	<div class="row">
		<div class="col-md-3">
			<h3 class="text-dark sectionHeader"><i class="fa fa-users"></i> {{ __('app.Members') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('home') }}">{{ __('app.Sell_new') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="#" data-toggle="modal" data-target="#memberModal">{{ __('app.New_member') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('members') }}">{{ __('app.Members_list') }}</a>
				</li>
			</ul>

			<h3 class="text-dark sectionHeader"><i class="fa fa-cannabis"></i> {{ __('app.ProductMain') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('categories') }}">{{ __('app.Categories') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('products') }}">{{ __('app.Products') }}</a>
				</li>
			</ul>

			<h3 class="text-dark sectionHeader"><i class="fa fa-coffee"></i> {{ __('app.Bar') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('bar') }}">{{ __('app.Categories') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('products.bar') }}">{{ __('app.Products') }}</a>
				</li>
			</ul>

			<h3 class="text-dark sectionHeader"><i class="fa fa-warehouse"></i> {{ __('app.Warehouses') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('suppliers') }}">{{ __('app.Suppliers') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('warehouses', ['type' => 'E']) }}">{{ __('app.Movements_in') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('warehouses', ['type' => 'S']) }}">{{ __('app.Movements_out') }}</a>
				</li>
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('expenses') }}">{{ __('app.Expenses_other') }}</a>
				</li>
			</ul>
		</div>
		<div class="col-md-3">
			<h3 class="text-secondary sectionHeader"><i class="fa fa-cogs"></i> {{ __('general.Configuration') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('site.edit', ['site' => session()->get('site')->id]) }}">{{ __('general.Site_config') }}</a>
				</li>	

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('menu.edit', ['menu' => session()->get('site')->id]) }}">{{ __('app.Menu') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('locales') }}">{{ __('general.Locales_change') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('users') }}">{{ __('general.Users') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="#" data-toggle="modal" data-target="#membersImportModal">{{ __('app.Members_import') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="#" id="backup" data-url="{{ route('backup') }}">{{ __('general.Backup') }}</a>
				</li>
			</ul>

			<h3 class="text-secondary sectionHeader"><i class="fa fa-chart-line"></i> {{ __('general.Statistics') }}</h3>
			@include('reports/partials/list')
		</div>
		<div class="col-md-6">
		    <div class="row">
	            <div class="col-md-4">
	                <div class="card mb-4 rounded-0 border-0">
	                    <div class="card-body text-center card-resume">
	                        <i class="fas fa-users fa-4x mb-3 text-info"></i>
	                        <h3><span id="count-members" style="display:none" data-pourl="{{ route('reports.count.members') }}">0</span>
	                        <i class="fas fa-spinner fa-pulse count-loading"></i></h3>
	                        <p class="mb-0">
	                            <a href="{{ route('members') }}"><small>{{ __('app.Members_active') }}</small></a>
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	            <div class="col-md-4">
	                <div class="card mb-4 rounded-0 border-0">
	                    <div class="card-body text-center card-resume">
	                        <i class="fas fa-balance-scale fa-4x mb-3 text-success"></i>
	                        <h3><span id="count-ie" style="display:none" data-pourl="{{ route('reports.count.ie') }}">0</span> 
	                        <i class="fas fa-spinner fa-pulse count-loading"></i><span class="counter-legend text-muted" style="display:none">{{ __('app.Coin') }}</span></h3>
	                        <p class="mb-0">
	                            <a href="{{ route('reports', ['type' => 'balance']) }}"><small>{{ __('app.Incomes') }} - {{ __('app.Expenses') }} ({{ __('general.Monthly') }})</small></a>
	                        </p>
	                    </div>
	                </div>
	            </div>

	            <div class="col-md-4">
	                <div class="card mb-4 rounded-0 border-0">
	                    <div class="card-body text-center card-resume">
	                        <i class="fas fa-coins fa-4x mb-3 text-warning"></i>
	                        <h3><span id="count-today" style="display:none" data-pourl="{{ route('reports.count.today') }}">0</span>
	                        <i class="fas fa-spinner fa-pulse count-loading"></i><span class="counter-legend text-muted" style="display:none">{{ __('app.Coin') }}</span></h3>
	                        <p class="mb-0">
	                            <a href="#"><small>{{ __('app.Incomes') }} ({{ __('general.Today') }})</small></a>
	                        </p>
	                    </div>
	                </div>
	            </div>
	        </div>
			<h3 class="sectionHeader">Stock</h3>
			<table class="table table-hover table-striped resumeFont">
				@php $total_stock = 0; @endphp
				@forelse ($stock as $elem)
				@if ($elem->category->bar == 0)
				@php $total_stock += $elem->amount; @endphp
				<tr>
					<td><b>{{ $elem->name }}</b> <em>{{ $elem->category->name }}</em></td>
					<td class="text-right">{{ $elem->price }} <small>{{ __('app.Coin') }}/{{ __('app.Gram') }}</small></td>
					<td class="text-right">{{ number_format($elem->amount, 2, ',', '.') }} <small>{{ strtolower( __('app.Grams')) }}</small></td>
				</tr>
				@endif
				@empty
				<tr>
					<td>{{ __('general.No_data_found') }}</td>
				</tr>
				@endforelse
			</table>
			<p class="resumeFont text-right"><big><b>{{ number_format($total_stock, 2, ',', '.') }} <small>{{ strtolower( __('app.Grams')) }}</small></b></big></p>
		</div>
	</div>
</div>

@include('members.partials.import')
<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('app.Member') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('members.partials.new')
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('vendor/bootstrap-filestyle-2.1.0/src/bootstrap-filestyle.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/counter.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webcam.js') }}"></script>
<script type="text/javascript" src="{{ url('js/member.js') }}"></script>
<script type="text/javascript" src="{{ url('js/backup.js') }}"></script>
<script type="text/javascript" src="{{ url('js/reports-count.js') }}"></script>
@endsection
