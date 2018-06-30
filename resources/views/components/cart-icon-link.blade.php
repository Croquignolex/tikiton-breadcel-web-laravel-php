<a href="javascript: void(0);" class="{{ $product->is_in_current_user_cart ? 'remove' : 'add-cart' }}"
   title="{{ $product->is_in_current_user_cart ? trans('general.remove_from_cart') : trans('general.add_to_cart') }}">
    <i class="{{ font($product->is_in_current_user_cart ? 'cart-arrow-down' : 'cart-plus') }}"
       data-bind="{{ $product->id }}"
       data-errortitle="{{ trans('auth.error') }}"
       data-addlabel="@lang('general.add_to_cart')"
       data-removelabel="@lang('general.remove_from_cart')"
       data-errormessage="{{ trans('general.script_error') }}"
       data-addurl="{{ locale_route('account.ajax.cart.add') }}"
       data-removeurl="{{ locale_route('account.ajax.cart.remove') }}"
       data-locale="{{ Illuminate\Support\Facades\App::getLocale() }}"
       @click="toggleProductInCart"></i>
</a>