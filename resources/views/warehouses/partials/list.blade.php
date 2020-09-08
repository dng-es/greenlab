@php
$tab = (isset($tab) ? $tab : 'warehouses');
@endphp
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th><orderby field="fullname" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Name') }}</th>
                <th><orderby field="product.name" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Product') }}</th>
                <th class="text-right"><orderby field="amount" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Amount') }}</th>
                <th class="text-right"><orderby field="amount_real" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>Real</th>
                <th class="text-right"><orderby field="price" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Price') }}</th>
                <th class="text-right"><orderby field="total" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('app.Total') }}</th>
                <th class="text-right"><orderby field="warehouses.created_at" order="{{ $order }}" orderby="{{ $orderby }}" search="{{ $search }}"></orderby>{{ __('general.Date') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($warehouses as $element)
            <tr>
                <td>
                @if ($type == 'E')
                    <a title="{{ __('general.Edit') }}" href="{{ route('supplier.edit', ['supplier' => $element->supplier_id]) }}">{{ $element->fullname }}</a>

                @else
                    <a title="{{ __('general.Edit') }}" href="{{ route('member.edit', ['member' => $element->member_id]) }}">{{ $element->fullname }}</a>

                @endif
                </td>
                <td><a title="{{ __('general.Edit') }}" href="{{ route('product.edit', ['product' => $element->product_id, 'bar' => $element->bar]) }}">{{ $element->product }}</a> <small class="text-muted">{{ $element->category }}</small></td>
                <td class="text-right">
                    <span class="@if($element->amount_real !== $element->amount ) text-danger @endif">
                        {{ $element->amount }}<br>
                        @if($element->bar == 0)
                        <small class="text-muted">{{  __('app.Grams') }}</small>
                        @else
                        <small class="text-muted">{{  __('app.Unit') }}</small>
                        @endif
                    </span>
                </td>
                <td class="text-right">
                    <span class="@if($element->amount_real !== $element->amount ) text-danger @endif">
                        {{ $element->amount_real }}<br>
                        @if($element->bar == 0)
                        <small class="text-muted">{{  __('app.Grams') }}</small>
                        @else
                        <small class="text-muted">{{  __('app.Unit') }}</small>
                        @endif
                    </span>
                </td>
                <td class="text-right">{{ $element->price }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                <td class="text-right">{{ $element->total }} <span class="text-muted">{{  __('app.Coin') }}</span></td>
                <td class="text-right" width="100px"><small>{{ $element->created_at }}</small></td>
                <td>
                    <button class="btn btn-sm btn-outline-danger btn-confirm" data-confirmbtn="{{ __('general.Delete') }}" data-msg="{{ __('general.SureToDelete') }}" data-url="{{ route('warehouse.destroy', ['warehouse' => $element->id]) }}" title="{{ __('general.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @empty
                <tr><td colspan="8" class="text-center text-danger">{{ __('general.No_data_found') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $warehouses->appends(['search' => $search, 'orderby' => $orderby, 'order' => $order, 'tab' => $tab])->links() }}