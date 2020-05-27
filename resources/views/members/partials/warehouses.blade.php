<div class="table-responsive">
    <table class="table table-hover table-striped table-sm resumeFont">
        <thead class="thead-dark">
            <tr>
                <th>{{ __('app.Product') }}</th>
                <th class="text-right">{{ __('app.Amount') }}</th>
                <th class="text-right">{{ __('app.Cost') }}</th>
                <th>{{ __('general.Date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouses as $element)
            <tr>
                <td>
                    <b>{{ $element->product }}</b> <em>{{ $element->category }}</em>
                </td>
                <td class="text-right">{{ $element->amount_real }}</td>
                <td class="text-right">{{ ($element->total) }} {{  __('app.Coin') }}</td>
                <td><small>{{ $element->created_at }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="warehouses-paginator">
    {{ $warehouses->links() }}
</div>