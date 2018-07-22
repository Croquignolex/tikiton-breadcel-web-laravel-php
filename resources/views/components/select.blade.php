<select class="{{ $class ?? '' }} selectpicker show-tick" title="{{ $title }}"
        @change="validateFormElement" data-validate="false" id="{{ $name }}"
        data-live-search="true" data-style="btn-light" name="{{ $name }}">
    @foreach($options as $option)
        <option value="{{ $option->id }}" {{ $value == $option->id ? 'selected' : ''}}
                data-subtext="{{ $option->en_name }}">
            {{ $option->fr_name }}
        </option>
    @endforeach
</select>