<a href="javascript: void(0);" class="{{ $class ?? '' }}">
    <i class="{{ font($icon) }}" @click="shouldConnect"
       data-body="@lang('general.' . $locale_message, ['product' => $product_name])"
       data-title="@lang('auth.info')"></i>
</a>