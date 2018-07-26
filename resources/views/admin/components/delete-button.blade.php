@component('components.modal-button', [
    'title' => $title, 'label' => $label ?? 'Supprimer', 'target' => $target,
    'class' => $class ?? 'btn btn-danger', 'icon' => $icon ?? 'trash-o',
    ])
@endcomponent