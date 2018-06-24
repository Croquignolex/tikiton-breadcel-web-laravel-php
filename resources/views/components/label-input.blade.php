<label for="{{ $name }}">
    @lang('general.' . $label)@if($is_required ?? TRUE)*@endif
    @if ($errors->has($name))
        <span class="text-danger">
            {{ $errors->first($name) }}
        </span>
    @endif
</label>
{{ $slot }}