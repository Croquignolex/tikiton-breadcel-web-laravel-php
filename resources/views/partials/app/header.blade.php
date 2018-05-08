<!--Start Header Area-->
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-lg-3">
                <div class="log-link">
                    <p>@lang('general.welcome_to_you')</p>
                    <h5>
                        <a href="{{ locale_route('login') }}">
                            <i class="{{ font('lock') }}"></i>
                            @lang('general.login')</a>
                        @lang('general.or')
                        <a href="{{ locale_route('register') }}">
                            <i class="{{ font('users') }}"></i>
                            @lang('general.register')
                        </a>
                    </h5>
                </div>
            </div>
            <div class="col-sm-4 col-lg-6">
                <div class="logo text-center">
                    <a href="{{ locale_route('home') }}">
                        <img src="{{ img_asset('logo') }}" alt="..." />
                        <h4>Cel & Cel Bread'Cel</h4>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3">
                <div class="cart-info float-right">
                    <a href="{{ locale_route('cart') }}">
                        <h5>
                            @lang('general.my_cart')
                            <span>2</span>
                            @lang('general.articles') -
                            <span>$390</span>
                        </h5>
                        <i class="{{ font('shopping-cart') }}"></i>
                    </a>
                    <div class="cart-hover">
                        <ul class="header-cart-pro">
                            <li>
                                <div class="image"><a href="#"><img alt="cart item" src=""></a></div>
                                <div class="content fix"><a href="#">Product Name</a><span class="price">Price: $130</span><span class="quantity">Quantity: 1</span></div>
                                <i class="fa fa-trash delete"></i>
                            </li>
                        </ul>
                        <div class="header-button-price">
                            <a href="{{ locale_route('checkout') }}">
                                <i class="{{ font('shopping-basket') }}"></i>
                                <span>@lang('general.check_out')</span>
                            </a>
                            <div class="total-price">
                                <h3>
                                    @lang('general.total_price') :
                                    <span>$390</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search float-right">
                    <form action="{{ locale_route('search') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" value="" placeholder="@lang('general.search')...." />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header Area-->