@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('reports', $type) }}

@include('layouts.messages')

@php
$total_incomes = ($total_incomes_products + $total_incomes_bar);
$total_expenses = ($total_expenses_other + $total_expenses_products);
$total = $total_incomes - $total_expenses ;
$total_class = ($total > 0 ? 'text-success' : 'text-danger');

@endphp
<div class="row">
	<div class="col-md-3">
		<div class="card border-0">
			<div class="card-body">
				@include('reports/partials/list', ['type' => $type])
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<h3 class="sectionHeader">{{ $title }}</h3>
		<hr>
		<div class="row">
			<div class="col-md-4">
				<h4>{{ __('app.Incomes') }}</h4>
				<table class="table table-hover table-striped resumeFont">
					<tr>
						<td>{{ __('app.ProductMain') }}</td>
						<td class="text-right">{{ number_format($total_incomes_products, 2, ',', '.') }} {{  __('app.Coin') }}</td>
					</tr>
					<tr>
						<td>{{ __('app.Bar') }}</td>
						<td class="text-right">{{ number_format($total_incomes_bar, 2, ',', '.') }} {{  __('app.Coin') }}</td>
					</tr>
					<tfoot class="font-weight-bold">
						<td>{{ __('app.Total') }}</td>
						<td class="text-right">{{ number_format($total_incomes, 2, ',', '.') }} {{ __('app.Coin') }}</td>
					</tfoot>
				</table>
			</div>
			<div class="col-md-4">
				<h4>{{ __('app.Expenses') }}</h4>
				<table class="table table-hover table-striped resumeFont">
					<tr>
						<td>{{ __('app.ProductMain') }}</td>
						<td class="text-right">{{ number_format($total_expenses_products, 2, ',', '.') }} {{  __('app.Coin') }}</td>
					</tr>				
					<tr>
						<td>{{ __('app.Expenses_other') }}</td>
						<td class="text-right">{{ number_format($total_expenses_other, 2, ',', '.') }} {{  __('app.Coin') }}</td>
					</tr>
					<tfoot class="font-weight-bold">
						<td>{{ __('app.Total') }}</td>
						<td class="text-right">{{ number_format($total_expenses, 2, ',', '.') }} {{ __('app.Coin') }}</td>
					</tfoot>
				</table>
			</div>
			<div class="col-md-4">
				<div class="row">
					@if ($show_months)
		            <div class="col-md-6">
		                <div class="form-group">
		                    <label for="month">{{ __('general.Month') }}:</label>
		                    @php
			                $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $year.'-01-01');
			                @endphp
		                    <select name="month" id="month" class="form-control">
		                    	@for ($i = 0; $i < 12; $i++)
								<option @php echo ($month==$fecha->format('m') ? 'selected' : '');@endphp value="{{ $fecha->format('m') }}">{{ ucfirst($fecha->monthName) }}</option>
								@php
				                $fecha->addMonth();
				                @endphp
								@endfor
		                    </select>
		                </div>
		            </div>
		            @endif

					<div class="col-md-6">
		                <div class="form-group">
		                    <label for="year">{{ __('general.Year') }}:</label>
		                    <select name="year" id="year" class="form-control">
		                    	@for ($i = \Carbon\Carbon::now()->format('Y'); $i >= $year_ini; $i--)
								<option @php echo ($year==$i ? 'selected' : '');@endphp value="{{ $i }}">{{ $i }}</option>
								@endfor
		                    </select>
		                </div>
		            </div>
		        </div>

				<div class="row">
		            <div class="col-md-12">
		                <div class="form-group">
							<button type="button" id="stats-refresh" data-url="{{ route('reports', ['type' => $type]) }}" class="btn btn-warning btn-lg"><i class="fa fa-sync text-white"></i> {{ __('general.Statistics_refresh') }}</button>
		                </div>
	            	</div>
		        </div>
		    </div>
		</div>
		<h3 class="{{ $total_class }}">{{ __('app.Total') }}: {{ $total }} {{ __('app.Coin') }}</h3>
	</div>
</div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dates.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/reports.js') }}"></script>
@endsection