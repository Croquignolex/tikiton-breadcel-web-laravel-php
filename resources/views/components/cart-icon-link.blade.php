<a href="javascript: void(0);" data-add="@lang('general.add_to_cart')" data-remove="@lang('general.remove_from_cart')"
   title="{{ $product->is_in_current_user_cart ? trans('general.remove_from_cart') : trans('general.add_to_cart') }}"
   class="{{ $product->is_in_current_user_cart ? 'remove' : 'add-cart' }}"
   data-locale="{{ Illuminate\Support\Facades\App::getLocale() }}">
    <i class="{{ font($product->is_in_current_user_cart ? 'cart-arrow-down' : 'cart-plus') }}" data-bind="{{ $product->id }}" data-url="{{ locale_route('account.ajax.cart.toggle') }}"
       data-errortitle="{{ trans('auth.error') }}" data-errormessage="{{ trans('general.script_error') }}"
       @click="toggleProductFromCart"></i>
</a>