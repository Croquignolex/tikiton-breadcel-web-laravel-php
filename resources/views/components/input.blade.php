<input placeholder="{{ $placeholder ?? '' }}"
       maxlength="{{ $maxlength ?? 255 }}" minlength="{{ $minlength ?? 2 }}"
       type="{{ $type }}" id="{{ $name  }}" name="{{ $name }}" value="{{ $value }}"
       class="{{ $class ?? '' }} min_max {{ $errors->has($name) ? 'form-invalid' : '' }}"
       {{ $auto_focus ?? ''}} {{ $readonly ?? '' }} @input="validateFormElement" />