<input type="{{ $type }}" id="{{ $name  }}" name="{{ $name }}" value="{{ $value }}"
       class="{{ $class ?? '' }} min_max {{ $errors->has($name) ? 'form-invalid' : '' }}"
       maxlength="{{ $maxlength ?? 255 }}" minlength="{{ $minlength ?? 2 }}"
       {{ $auto_focus ?? ''}} {{ $readonly ?? '' }} @keyup="validateFormElement"
       @change="validateFormElement" />