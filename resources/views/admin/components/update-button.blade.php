@component('components.link', [
    'link' => $route, 'label' => $label ?? 'Modifier', 'title' => $title,
    'class' => $class ?? 'btn btn-warning', 'icon' => 'pencil',
    ])
@endcomponent