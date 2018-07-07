<a href="javascript: void(0);"
   class="{{ $product->is_in_current_user_wish_list ? 'remove' : 'favorite' }}"
   title="{{ $product->is_in_current_user_wish_list ? trans('general.remove_from_wish_list') : trans('general.add_to_wish_list') }}">
    <i class="{{ font($product->is_in_current_user_wish_list ? 'heart' : 'heart-o') }}"
       data-bind="{{ $product->id }}"
       data-errortitle="{{ trans('auth.error') }}"
       data-addlabel="@lang('general.add_to_wish_list')"
       data-removelabel="@lang('general.remove_from_wish_list')"
       data-errormessage="{{ trans('general.script_error') }}"
       data-addurl="{{ locale_route('wishlist.ajax.add.product') }}"
       data-removeurl="{{ locale_route('wishlist.ajax.remove.product') }}"
       data-locale="{{ Illuminate\Support\Facades\App::getLocale() }}"
       @click="toggleProductInWishList"></i>
</a>

