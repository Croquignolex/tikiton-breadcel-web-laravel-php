<div class="cart-info float-right">
    <a href="{{ locale_route('cart.index') }}" title="@lang('general.manage_cart')">
        <h5>
            @lang('general.my_cart')
            <span class="text-theme" id="products-number">{{ \Illuminate\Support\Facades\Auth::user()->carted_products->count() }}</span>
            @lang('general.products')
        </h5>
        <i class="{{ font('shopping-cart') }}"></i>
    </a>
    <div class="cart-hover">
        <ul class="header-cart-pro" id="cart">
            @foreach(\Illuminate\Support\Facades\Auth::user()->carted_products as $product)
                <li>
                    <div class="image">
                        <a href="{{ locale_route('products.show', [$product]) }}"
                            class="{{ $product->stock === 0 ? 'out-of-stock' : '' }}">
                            <img alt="..." src="{{ $product->image_path }}">
                        </a>
                    </div>
                    <div class="content fix">
                        <a href="{{ locale_route('products.show', [$product]) }}">
                            {{ $product->format_name }}
                        </a>
                        @if($product->discount === 0)
                           <span class="new">@lang('general.price'): {{ money_currency($product->amount) }}</span>
                        @else
                            <span class="new"> @lang('general.price'): {{ money_currency($product->new_price) }}</span>
                            <span class="old">{{ money_currency($product->amount) }}</span>
                        @endif
                    </div>
                    <i class="{{font('trash')  }} delete"
                       data-bind="{{ $product->id }}"
                       data-errortitle="{{ trans('auth.error') }}"
                       data-errormessage="{{ trans('general.script_error') }}"
                       data-url="{{ locale_route('account.ajax.cart.remove') }}"
                       data-locale="{{ Illuminate\Support\Facades\App::getLocale() }}"
                       @click="removeProductFromCart"></i>
                </li>
            @endforeach
        </ul>
        <div class="header-button-price">
            <a href="{{ locale_route('cart.index') }}" title="@lang('general.manage_cart')">
                <i class="{{ font('shopping-cart') }}"></i>
                <span>@lang('general.cart')</span>
            </a>
            <div class="total-price">
                <button type="button" class="btn btn-danger" title="@lang('general.empty_your_cart')">
                    <i class="{{ font('trash-o') }}"></i>
                    <span @click="removeAllProductsFromCart"
                          data-errortitle="{{ trans('auth.error') }}"
                          data-errormessage="{{ trans('general.script_error') }}"
                          data-url="{{ locale_route('account.ajax.cart.remove.all') }}">
                        @lang('general.empty')</span>
                </button>
            </div>
        </div>
    </div>
</div>