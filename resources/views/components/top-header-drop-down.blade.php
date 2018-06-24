<li>
    <a href="javascript: void(0);">
        @if(isset($selected_icon))
            <img src="{{ $selected_icon }}" alt="...">
        @endif
        {{ $selected }}
        <i class="{{ font('angle-down') }}"></i>
    </a>
    <ul>
        {{ $slot }}
    </ul>
</li>