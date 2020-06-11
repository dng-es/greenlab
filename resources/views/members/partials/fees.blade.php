<div class="table-responsive">
    <table class="table table-hover table-striped table-sm resumeFont">
        <thead class="thead-dark">
            <tr>
                <th>{{ __('general.Created_by') }}</th>
                <th class="text-right">{{ __('app.Price') }}</th>
                <th class="text-right">{{ __('general.Date_ini') }}</th>
                <th class="text-right">{{ __('general.Date_end') }}</th>
                <th>{{ __('general.Notes') }}</th>
                <th>{{ __('general.Created_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fees as $element)
            <tr>
                <td>{{ ($element->user->name) }} {{  $element->user->last_name }}</td>
                <td class="text-right">{{ ($element->price) }} {{  __('app.Coin') }}</td>
                <td class="text-right">{{ $element->init_at->format('Y-m-d') }}</td>
                <td class="text-right">{{ $element->end_at->format('Y-m-d') }}</td>
                <td><small>{{ $element->notes }}</small></td>
                <td><small>{{ $element->created_at }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="credits-paginator">
    {{ $fees->links() }}
</div>