<!-- Single Product Start -->
<div class="product-item fix">
    <div class="product-img-hover">
        <!-- Product image -->
        <a href="{{ locale_route('products.show', [$product]) }}"
           class="pro-image fix {{ $product->stock === 0 ? 'out-of-stock' : '' }}">
            <img src="{{ $product->image_path }}" alt="..." />
        </a>
        @if($product->is_a_new)
            <div class="new-pro"><img src="{{ product_img_asset('new', 'png') }}" alt="..." /></div>
        @endif
        @if($product->is_a_discount)
            <div class="hot-pro"><img src="{{ product_img_asset('hot', 'png') }}" alt="..." /></div>
        @endif
        <!-- Product action Btn -->
        <div class="product-action-btn">
            @auth
                @component('components.app.wish-list-icon-link', compact('product'))
                @endcomponent
            @endauth
            @component('components.app.icon-link', [
               'icon' => 'cart-plus', 'link' => '#',
               'class' => 'add-cart'
               ])
            @endcomponent
        </div>
    </div>
    <div class="pro-name-price-ratting">
        <!-- Product Name -->
        <div class="pro-name">
            <a href="{{ locale_route('products.show', [$product]) }}">
                {{ $product->format_name }}
            </a>
        </div>
        @component('components.app.star-ranking',
            ['ranking' => $product->ranking])
        @endcomponent
        <div class="pro-price fix">
            <p>
                @if($product->discount === 0)
                    <span class="new">{{ money_currency($product->amount) }}</span>
                @else
                    <span class="old">{{ money_currency($product->amount) }}</span>
                    <span class="new">{{ money_currency($product->new_price) }}</span>
                @endif
            </p>
        </div>
    </div>
</div>
<!-- Single Product End -->