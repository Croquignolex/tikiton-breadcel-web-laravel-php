<textarea id="{{ $name }}" name="{{ $name }}" maxlength="{{ $maxlength ?? 510 }}" {{ $readonly ?? '' }}
          class="{{ $class ?? '' }} min_max {{ $errors->has($name) ? 'form-invalid' : '' }}"
          rows="{{ $rows ?? 7 }}" minlength="{{ $minlength ?? 2 }}" placeholder="{{ $placeholder ?? '' }}"
          @keyup="validateElement" @change="validateElement">{{ $value }}</textarea>