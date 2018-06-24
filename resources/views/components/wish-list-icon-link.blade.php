<a href="javascript: void(0);" data-add="@lang('general.add_to_wish_list')" data-remove="@lang('general.remove_from_wish_list')"
   title="{{ $product->is_in_current_user_wish_list ? trans('general.remove_from_wish_list') : trans('general.add_to_wish_list') }}"
   class="{{ $product->is_in_current_user_wish_list ? 'remove' : 'favorite' }}">
    <i class="{{ font($product->is_in_current_user_wish_list ? 'heart' : 'heart-o') }}" data-bind="{{ $product->id }}" data-url="{{ locale_route('account.ajax.wishlist.toggle') }}"
       data-errortitle="{{ trans('auth.error') }}" data-errormessage="{{ trans('general.script_error') }}"
       @click="toggleProductFromWishList"></i>
</a>