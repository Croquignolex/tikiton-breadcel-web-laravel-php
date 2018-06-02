@inject('productService', 'App\Services\ProductService')
<!-- Single Product Start -->
<div class="product-item fix">
    <div class="product-img-hover">
        <!-- Product image -->
        <a href="{{ locale_route('products.show', [$product]) }}" class="pro-image fix">
            <img src="{{ $product->image_path }}" alt="..." />
        </a>
        @if($productService->isNew($product))
            <div class="new-pro"><img src="{{ product_img_asset('new', 'png') }}" alt="..." /></div>
        @endif
        @if($productService->isFeatured($product))
            <div class="hot-pro"><img src="{{ product_img_asset('hot', 'png') }}" alt="..." /></div>
        @endif
        <!-- Product action Btn -->
        <div class="product-action-btn">

            @component('components.app.icon-link', [
                'icon' => 'search', 'link' => '#',
                'class' => 'quick-view'
                ])
            @endcomponent
            @component('components.app.icon-link', [
               'icon' => 'heart-o', 'link' => '#',
               'class' => 'favorite'
               ])
            @endcomponent
            @component('components.app.icon-link', [
               'icon' => 'shopping-cart', 'link' => '#',
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
        <!-- Product Ratting -->
        <div class="pro-ratting">
            @component('components.app.star-ranking',
                ['ranking' => $product->ranking])
            @endcomponent
        </div>
        <!-- Product Price -->
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
