<a href="javascript: void(0);" class="favorite">
    <i class="{{ font($product->is_in_current_user_wish_list ? 'heart' : 'heart-o') }}" data-bind="{{ $product->id }}" data-url="{{ locale_route('account.ajax.wishlist.manage') }}"
       data-errortitle="{{ trans('auth.error') }}" data-errormessage="{{ trans('general.script_error') }}"
       @click="addOrRemoveProductFromWishList"></i>
</a>