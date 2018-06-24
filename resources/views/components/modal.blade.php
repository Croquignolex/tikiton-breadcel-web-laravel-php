<!-- Start modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modal-title-{{ $id }}">
                    <strong>{{ $title }}</strong>
                </h4>
            </div>
            <div class="modal-body bg-{{ $color }} text-white">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="{{ font('close') }}"></i>
                    @lang('general.no')
                </button>
                <button type="button" class="btn btn-{{ $color }}" onclick="document.getElementById('action-{{ $id }}').submit();">
                    <i class="{{ font('check') }}"></i>
                    @lang('general.yes')
                </button>
            </div>
        </div>
    </div>
</div>

@component('components.modal-form-action',
    ['id' => 'action-' . $id, 'route' => $action_route])
@endcomponent
<!-- End modal -->