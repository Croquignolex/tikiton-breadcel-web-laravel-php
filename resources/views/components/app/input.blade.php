<input type="{{ $type }}" id="{{ $name  }}" name="{{ $name }}" value="{{ $value }}"
       class="{{ $class ?? '' }} min_max {{ $errors->has($name) ? 'form-invalid' : '' }}"
       maxlength="{{ $maxlength ?? 255 }}" minlength="{{ $minlength ?? 2 }}"
       v-on:keyup="validateElement" v-on:change="validateElement"
        {{ $auto_focus ?? ''}}/>