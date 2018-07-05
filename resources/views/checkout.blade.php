@inject('cartService', 'App\Services\CartService')
@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.checkout')))
@section('overlay_text', trans('checkout'))
@section('overlay_font', font('shopping-cart'))

@section('app.home.body')
    <!--Start Checkout Area-->
    <section class="checkout-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <form action="{{ locale_route('checkout.update') }}" method="POST" @submit="validateFormElements">
                        {{ csrf_field() }}
                        <div class="panel-group" id="checkout-progress">
                            <div class="panel panel-default">
                                <div class="panel-heading" >
                                    <a class="active" data-toggle="collapse" data-parent="#checkout-progress" href="#bill-info">
                                        <span>1</span>{{ mb_strtoupper(trans('general.billing_information')) }}
                                    </a>
                                </div>
                                <div id="bill-info" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="bill-info">
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'first_name', 'class' => 'half',
                                                    'value' => $user->first_name ?? old('first_name'), 'auto_focus' => 'autofocus',
                                                    'placeholder' => trans('general.first_name') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'last_name',
                                                    'value' => $user->last_name ?? old('last_name'), 'class' => 'half',
                                                    'placeholder' => trans('general.last_name') . '*'
                                                    ])
                                                @endcomponent
                                            </div>
                                            @component('components.input', [
                                                'value' => $user->company ?? old('company'),
                                                'type' => 'text', 'name' => 'company',
                                                'placeholder' => trans('general.company') . '(' . trans('general.optional') . ')'
                                                ])
                                            @endcomponent
                                            @component('components.input', [
                                                'value' => $user->address ?? old(''),
                                                'type' => 'text', 'name' => 'address',
                                                'placeholder' => trans('general.address') . '*'
                                                ])
                                            @endcomponent
                                            @component('components.input', [
                                                'value' => $user->post_code ?? old('post_code'),
                                                'type' => 'text', 'name' => 'post_code',
                                                'placeholder' => trans('general.post_code') . '*'
                                                ])
                                            @endcomponent
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'city',
                                                    'value' => $user->city ?? old('city'), 'class' => 'half',
                                                    'placeholder' => trans('general.city') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'country',
                                                    'value' => $user->country ?? old('country'), 'class' => 'half',
                                                    'placeholder' => trans('general.country') . '*'
                                                    ])
                                                @endcomponent
                                            </div>
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'phone',
                                                    'value' => $user->phone ?? old('phone'), 'class' => 'half',
                                                    'placeholder' => trans('general.phone') . '*'
                                                    ])
                                                @endcomponent
                                                <p class="text-right text-theme">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" >
                                    <a class="collapsed" data-toggle="collapse" data-parent="#checkout-progress" href="#shipping-info">
                                        <span>2</span>{{ mb_strtoupper(trans('general.shipping_information')) }}
                                    </a>
                                </div>
                                <div id="shipping-info" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="bill-info">
                                            @component('components.input', [
                                                'value' => $user->shipping_address ?? old('shipping_address'),
                                                'type' => 'text', 'name' => 'shipping_address',
                                                'placeholder' => trans('general.address') . '*'
                                                ])
                                            @endcomponent
                                            @component('components.input', [
                                                'value' => $user->shipping_post_code ?? old('shipping_post_code'),
                                                'type' => 'text', 'name' => 'shipping_post_code',
                                                'placeholder' => trans('general.post_code') . '*'
                                                ])
                                            @endcomponent
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'shipping_city',
                                                    'value' => $user->shipping_city ?? old('shipping_city'), 'class' => 'half',
                                                    'placeholder' => trans('general.city') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'shipping_country',
                                                    'value' => $user->shipping_country ?? old('shipping_country'), 'class' => 'half',
                                                    'placeholder' => trans('general.country') . '*'
                                                    ])
                                                @endcomponent
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" >
                                    <a class="collapsed" data-toggle="collapse" data-parent="#checkout-progress" href="#payment-met">
                                        <span>3</span>{{ mb_strtoupper(trans('general.payment_method')) }}
                                    </a>
                                </div>
                                <div id="payment-met" class="panel-collapse collapse">
                                    <div class="panel-body">
                                         <p>@lang('general.payment_method_desc')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" >
                                    <a class="collapsed" data-toggle="collapse" data-parent="#checkout-progress" href="#order-review">
                                        <span>4</span>{{ mb_strtoupper(trans('general.oder_review')) }}
                                    </a>
                                </div>
                                <div id="order-review" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-4">
                                            <div class="information">
                                                <h3>{{ mb_strtoupper(trans('general.billing_information')) }}</h3>
                                                <p>
                                                    {{ $user->first_name }} {{ $user->last_name }} <br />
                                                    {{ $user->email }} <br />
                                                    {{ $user->phone }} <br />
                                                    {{ $user->company }}
                                                </p>
                                                <p>
                                                    {{ $user->address }} <br />
                                                    {{ $user->post_code }} {{ $user->city }} {{ $user->country }}
                                                </p>
                                                @component('components.submit', [
                                                    'class' => 'shipping', 'value' => trans('general.update_info'),
                                                    'title' => trans('general.reload_overview')
                                                    ])
                                                @endcomponent
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="information">
                                                <h3>{{ mb_strtoupper(trans('general.shipping_information')) }}</h3>
                                                <p>
                                                    {{ $user->shipping_address }} <br />
                                                    {{ $user->shipping_post_code }} {{ $user->shipping_city }} {{ $user->shipping_country }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="information">
                                                <h3>{{ mb_strtoupper(trans('general.payment_method')) }}</h3>
                                                <p>@lang('general.payment_method_desc')</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="place-order">
                                                <div class="order-list">
                                                    <div class="row cart-oveview-line">
                                                        <div class="col-xs-4">
                                                            <strong>{{ mb_strtoupper(trans('general.quantity')) }}</strong>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <strong>{{ mb_strtoupper(trans('general.products')) }}</strong>
                                                        </div>
                                                        <div class="col-xs-4 text-right">
                                                            <strong>{{ mb_strtoupper(trans('general.total')) }}</strong>
                                                        </div>
                                                    </div>
                                                    @foreach($carted_products as $carted_product)
                                                        <div class="row cart-oveview-line">
                                                            <div class="col-xs-4">
                                                                {{ $carted_product->pivot->quantity }}
                                                            </div>
                                                            <div class="col-xs-4">
                                                                {{ $carted_product->format_name }}
                                                            </div>
                                                            <div class="col-xs-4">
                                                                @if($carted_product->is_a_discount)
                                                                    <span>
                                                                    <i class="old">{{ money_currency($carted_product->cart_line_value) }}</i>
                                                                        {{ money_currency($carted_product->cart_discount_line_value) }}
                                                                </span>
                                                                @else
                                                                    <span>{{ money_currency($carted_product->cart_line_value) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="row cart-oveview-line text-uppercase">
                                                        <div class="col-xs-6">
                                                            <strong>@lang('general.sub_total')</strong>
                                                        </div>
                                                        <div class="col-xs-6 text-right">
                                                            <strong>
                                                                {{ money_currency($cartService->getSubTotal()) }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row cart-oveview-line text-uppercase">
                                                        <div class="col-xs-6">
                                                            <strong>@lang('general.tva') ({{ $cartService->getTVAPercentage() }}%)</strong>
                                                        </div>
                                                        <div class="col-xs-6 text-right">
                                                            <strong>
                                                                {{ money_currency($cartService->getTVA()) }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row cart-oveview-line text-uppercase">
                                                        <div class="col-xs-6">
                                                            <strong>@lang('general.coupon') {{ $cartService->getCouponCode() }}</strong>
                                                        </div>
                                                        <div class="col-xs-6 text-right">
                                                            <strong>
                                                                - {{ money_currency($cartService->getCouponDiscount()) }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div class="row text-theme h3 text-uppercase">
                                                        <div class="col-xs-6">
                                                            @lang('general.big_total')
                                                        </div>
                                                        <div class="col-xs-6 text-right">
                                                            {{ money_currency($cartService->getBigTotal()) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="final-total">
                                                    <a href="javascript: void(0);"
                                                       onclick="document.getElementById('place-order').submit();">
                                                        @lang('general.order')
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="checkout-right">
                        <h2>@lang('general.short_links')</h2>
                        <ul>
                            <li><a href="{{ locale_route('products.index') }}">@lang('general.products')</a></li>
                            <li><a href="{{ locale_route('cart.index') }}">@lang('general.my_cart')</a></li>
                            <li><a href="{{ locale_route('account.wishlist') }}">@lang('general.my_wish_list')</a></li>
                            <li><a href="{{ locale_route('account.index') }}">@lang('general.my_account')</a></li>
                        </ul>
                    </div>
                </div>
                <form id="place-order" method="POST" class="hidden" action="">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </section>
    <!--End Checkout Area-->
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
@endpush