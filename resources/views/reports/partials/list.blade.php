@php
$type = (isset($type) ? $type : '');
@endphp
<ul class="fa-ul">
	<li class="@php echo ($type == 'top_month' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_month' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_month']) }}">{{ __('app.Top_month') }}</a>
	</li>

	<li class="@php echo ($type == 'top_year' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_year' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_year']) }}">{{ __('app.Top_year') }}</a>
	</li>

	<li class="@php echo ($type == 'top_category_month' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_category_month' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_category_month']) }}">{{ __('app.Top_category_month') }}</a>
	</li>

	<li class="@php echo ($type == 'top_category_year' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_category_year' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_category_year']) }}">{{ __('app.Top_category_year') }}</a>
	</li>				

	<li class="@php echo ($type == 'top_member_month' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_member_month' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_member_month']) }}">{{ __('app.Top_member_month') }}</a>
	</li>

	<li class="@php echo ($type == 'top_member_year' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_member_year' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_member_year']) }}">{{ __('app.Top_member_year') }}</a>
	</li>

	<li class="@php echo ($type == 'top_supplier_month' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_supplier_month' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_supplier_month']) }}">{{ __('app.Top_supplier_month') }}</a>
	</li>

	<li class="@php echo ($type == 'top_supplier_year' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'top_supplier_year' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'top_supplier_year']) }}">{{ __('app.Top_supplier_year') }}</a>
	</li>

	<li class="@php echo ($type == 'balance' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'balance' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'balance']) }}">{{ __('app.Incomes') }} - {{ __('app.Expenses') }} ({{ __('general.Monthly') }})</a>
	</li>

	<li class="@php echo ($type == 'balance_annual' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'balance_annual' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('reports', ['type' => 'balance_annual']) }}">{{ __('app.Incomes') }} - {{ __('app.Expenses') }} ({{ __('general.Annual') }})</a>
	</li>
	<li class="@php echo ($type == 'export_credit' ? 'font-weight-bold' : '');@endphp">
		<span class="fa-li"><i class="far @php echo ($type == 'export_credit' ? 'fa-check-square' : 'fa-square');@endphp"></i></span>
		<a href="{{ route('members.export',['exportOption' => 'xlsx','credit' => true]) }}">{{ __('app.Members_with_credit') }}</a>
	</li>				
</ul>