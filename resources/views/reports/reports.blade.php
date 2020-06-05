@extends('layouts.appadmin')

@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{ url('vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content_admin')
{{ Breadcrumbs::render('reports', $type) }}

@include('layouts.messages')

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
			<div class="col-md-5">
				<table class="table table-hover table-striped resumeFont">
					@forelse ($data as $elem)
					<tr>
						<td>{{ $elem->name }}</td>
						<td class="text-right">{{ number_format($elem->total, 2, ',', '.') }} {{  __('app.Coin') }}</td>
						<td class="text-right">{{ number_format($elem->total2, 2, ',', '.') }} <small>{{ strtolower( __('app.Grams')) }}</small></td>
					</tr>
					@empty
					<tr>
						<td>{{ __('general.No_data_found') }}</td>
					</tr>
					@endforelse
				</table>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-3">
		                <div class="form-group">
		                    <label for="limit">{{ __('general.Num_items') }}:</label>
		                    <input type="number" name="limit" id="limit" value="{{ $limit }}" class="form-control text-right" />
		                </div>
		            </div>
					<div class="col-md-3">
		                <div class="form-group">
		                    <label for="order">{{ __('general.Order') }}:</label>
		                    <select name="order" id="order" class="form-control">
								<option @php echo ($order=='total' ? 'selected' : '');@endphp value="total">{{ __('app.Cost') }}</option>
								<option @php echo ($order=='total2' ? 'selected' : '');@endphp value="total2">{{ __('app.Amount') }}</option>
		                    </select>
		                </div>
		            </div>
		            @if ($show_months)
		            <div class="col-md-3">
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
	                @else
					<input type="hidden" name="month" id="month" value="{{ $month }}" />
	                @endif

					<div class="col-md-3">
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
	</div>
</div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ url('vendor/momentjs/momentjs.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dates.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/reports.js') }}"></script>
@endsection