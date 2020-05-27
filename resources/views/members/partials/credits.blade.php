<div class="table-responsive">
    <table class="table table-hover table-striped table-sm resumeFont">
        <thead class="thead-dark">
            <tr>
                <th>{{ __('general.User') }}</th>
                <th class="text-right">{{ __('app.Cost') }}</th>
                <th class="text-right">{{ __('app.Member_balance') }}</th>
                <th>{{ __('general.Notes') }}</th>
                <th>{{ __('general.Date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($credits as $element)
            <tr>
                <td>{{ ($element->user->name) }} {{  $element->user->last_name }}</td>
                <td class="text-right">{{ ($element->credit) }} {{  __('app.Coin') }}</td>
                <td class="text-right">{{ $balance }} {{  __('app.Coin') }}</td>
                <td><small>{{ $element->notes }}</small></td>
                <td><small>{{ $element->created_at }}</small></td>
            </tr>
            @php $balance -= $element->credit@endphp
            @endforeach
        </tbody>
    </table>
</div>

<div id="credits-paginator">
    {{ $credits->links() }}
</div>