@php
$tab = (isset($tab) ? $tab : 'warehouses')
@endphp
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th><orderby field="fullname" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Name') }}</th>
                <th><orderby field="product.name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Product') }}</th>
                <th class="text-right"><orderby field="amount" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Amount') }}</th>
                <th class="text-right"><orderby field="amount_real" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Amount') }} real</th>
                <th class="text-right"><orderby field="price" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Price') }}</th>
                <th class="text-right"><orderby field="total" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Total') }}</th>
                <th class="text-right"><orderby field="warehouses.created_at" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($warehouses as $element)
            <tr>
                <td>{{ $element->fullname }}</td>
                <td>{{ $element->product }} <small class="text-muted">{{ $element->category }}</small></td>
                <td class="text-right">
                    {{ $element->amount }}
                    @if($element->bar ==0)
                    <small class="text-muted">{{  __('app.Grams') }}</small>
                    @endif
                </td>
                <td class="text-right">
                    {{ $element->amount_real }}
                    @if($element->bar ==0)
                    <small class="text-muted">{{  __('app.Grams') }}</small>
                    @endif
                </td>
                <td class="text-right">{{ $element->price }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                <td class="text-right">{{ $element->total }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                <td class="text-right"><small>{{ $element->created_at }}</small></td>
                <td>
                    <button class="btn btn-sm btn-outline-danger btn-confirm" data-confirmbtn="{{ __('general.Delete') }}" data-msg="{{ __('general.SureToDelete') }}?" data-url="{{ route('warehouse.destroy', ['warehouse' => $element->id]) }}" title="{{ __('general.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @empty
                <tr><td colspan="8" class="text-center text-danger">{{ __('general.No_data_found') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $warehouses->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order, 'tab' => $tab])->links() }}