@inject('cartService', 'App\Services\CartService')

<div class="cart-info float-right">
    <a href="{{ locale_route('cart') }}">
        <h5>
            @lang('general.my_cart')
            <span class="text-theme" id="products-number">{{ $cartService->getProductNumber() }}</span>
            @lang('general.products')
        </h5>
        <i class="{{ font('shopping-cart') }}"></i>
    </a>
    <div class="cart-hover">
        <ul class="header-cart-pro" id="cart">
            @foreach($cartService->getCartProducts() as $product)
                <li>
                    <div class="image">
                        <a href="{{ locale_route('products.show', [$product]) }}">
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
                    <i class="{{font('trash')  }} delete" data-bind="{{ $product->id }}"
                       data-locale="{{ Illuminate\Support\Facades\App::getLocale() }}"
                       @click="removeProductFromCart"></i>
                </li>
            @endforeach
        </ul>
        <div class="header-button-price">
            <a href="{{ locale_route('checkout') }}">
                <i class="{{ font('shopping-basket') }}"></i>
                <span>@lang('general.check_out')</span>
            </a>
        </div>
    </div>
</div>