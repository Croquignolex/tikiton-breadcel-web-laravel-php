<li>
    <a href="#">
        <img src="{{ $selected_icon }}" alt="...">
        {{ $selected }}
        <i class="{{ font('angle-down') }}"></i>
    </a>
    <ul>
        {{ $slot }}
    </ul>
</li>