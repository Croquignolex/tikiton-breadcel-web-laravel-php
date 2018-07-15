<textarea data-validate="{{ $validate ?? 'true' }}"   id="{{ $name }}"  maxlength="{{ $maxlength ?? 510 }}"
  {{ $readonly ?? '' }} name="{{ $name }}" rows="{{ $rows ?? 7 }}" minlength="{{ $minlength ?? 2 }}"
  class="{{ $class ?? '' }} min_max {{ $errors->has($name) ? 'form-invalid' : '' }}" placeholder="{{ $placeholder ?? '' }}"
  @input="validateFormElement">{{ $value }}</textarea>