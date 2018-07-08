<label for="{{ $name }}">
    @lang('general.' . $label)@if($is_required ?? TRUE){{ $no_star ?? '*' }}@endif
    @if ($errors->has($name))
        <span class="text-danger">
            {{ $errors->first($name) }}
        </span>
    @endif
</label>
{{ $slot }}