<textarea id="{{ $name }}" name="{{ $name }}" maxlength="{{ $maxlength ?? 510 }}"
          class="{{ $class ?? '' }} min_max {{ $errors->has($name) ? 'form-invalid' : '' }}"
          rows="{{ $rows ?? 7 }}" minlength="{{ $minlength ?? 2 }}"
          v-on:keyup="validateElement" v-on:change="validateElement">{{ $value }}</textarea>