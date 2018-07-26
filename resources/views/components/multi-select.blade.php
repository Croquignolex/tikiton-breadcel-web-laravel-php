<select class="{{ $class ?? '' }} selectpicker show-tick" name="{{ $name. '[]' }}" title="{{ $title }}"
        @change="validateFormElement" data-validate="false" multiple id="{{ $name }}"
        data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light">
    @foreach($options as $option)
        <option value="{{ $option->id }}" {{ in_array($option->id, $values) ? 'selected' : ''}}
                data-subtext="{{ $option->select_subtext }}">
                {{ $option->select_text }}
        </option>
    @endforeach
</select>