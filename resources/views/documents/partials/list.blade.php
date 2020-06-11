@php
$tab = (isset($tab) ? $tab : 'documents')
@endphp
<div class="table-responsive">
    <table class="table table-hover">
        <tbody>
            @forelse ($documents as $element)
            <tr>
                <td><a target="_blank" href="{{ Storage::disk('user_images')->url($element->file) }}">{{ $element->name }}</a></td>
                <td width="40px">
                    <button class="btn btn-sm btn-outline-danger btn-confirm" data-confirmbtn="{{ __('general.Delete') }}" data-msg="{{ __('general.SureToDelete') }}?" data-url="{{ route('member.document.destroy', ['document' => $element->id]) }}" title="{{ __('general.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @empty
                <tr><td class="text-center text-danger">{{ __('general.No_data_found') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>