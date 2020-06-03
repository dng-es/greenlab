@extends('layouts.appadmin')

@section('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('dashboard') }}

@include('layouts.messages')
test
@if($update_app)
<div class="alert alert-warning">Actualización disponible</div>
@endif
<div class="">
	<div class="row">
		<div class="col-md-3">
			<h3 class=""><i class="fa fa-users"></i> {{ __('app.Members') }}</h3>
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

			<h3 class=""><i class="fa fa-glass-cheers"></i> {{ __('app.Bar') }}</h3>
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

			<h3 class=""><i class="fa fa-cannabis"></i> Cannabis</h3>
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

			<h3 class=""><i class="fa fa-warehouse"></i> {{ __('app.Warehouses') }}</h3>
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
			<h3 class=""><i class="fa fa-cogs"></i> {{ __('general.Configuration') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('menu.edit', ['menu' => 1]) }}">{{ __('app.Menu') }}</a>
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
					<a href="#" id="backup" data-url="{{ route('backup') }}">{{ __('general.Backup') }}</a>
				</li>
			</ul>

			<h3 class=""><i class="fa fa-chart-line"></i> {{ __('general.Statistics') }}</h3>
			<ul class="fa-ul">
				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_month']) }}">{{ __('app.Top_month') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_year']) }}">{{ __('app.Top_year') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_category_month']) }}">{{ __('app.Top_category_month') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_category_year']) }}">{{ __('app.Top_category_year') }}</a>
				</li>				

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_member_month']) }}">{{ __('app.Top_member_month') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_member_year']) }}">{{ __('app.Top_member_year') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_supplier_month']) }}">{{ __('app.Top_supplier_month') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_supplier_year']) }}">{{ __('app.Top_supplier_year') }}</a>
				</li>

				<li>
					<span class="fa-li"><i class="far fa-square"></i></span>
					<a href="{{ route('reports', ['type' => 'top_supplier_year']) }}">{{ __('app.Incomes') }} - {{ __('app.Expenses') }}</a>
				</li>
			</ul>
		</div>
		<div class="col-md-6">
			<h3 class="sectionHeader">Stock</h3>
			<table class="table table-hover table-striped resumeFont">
				@php $total_stock = 0; @endphp
				@forelse ($stock as $elem)
				@if ($elem->category->bar == 0)
				@php $total_stock += $elem->amount; @endphp
				<tr>
					<td><b>{{ $elem->name }}</b> <em>{{ $elem->category->name }}</em></td>
					<td class="text-right">{{ $elem->price }} €</td>
					<td class="text-right">{{ $elem->amount }} <small>{{ strtolower( __('app.Grams')) }}</small></td>
				</tr>
				@endif
				@empty
				<tr>
					<td>{{ __('general.No_data_found') }}</td>
				</tr>
				@endforelse
			</table>
			<p class="resumeFont text-right"><big><b>{{ $total_stock }} <small>{{ strtolower( __('app.Grams')) }}</small></b></big></p>
		</div>
	</div>
</div>

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
<script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ url('js/dates.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webcam.js') }}"></script>
<script type="text/javascript" src="{{ url('js/member.js') }}"></script>
<script type="text/javascript" src="{{ url('js/backup.js') }}"></script>
@endsection
