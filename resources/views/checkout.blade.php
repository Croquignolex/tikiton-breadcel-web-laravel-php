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
                    <form action="" method="POST" @submit="validateFormElements">
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
                                                    'value' => old('first_name'), 'auto_focus' => 'autofocus',
                                                    'placeholder' => trans('general.first_name') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'last_name',
                                                    'value' => old('last_name'), 'class' => 'half',
                                                    'placeholder' => trans('general.last_name') . '*'
                                                    ])
                                                @endcomponent
                                            </div>
                                            @component('components.input', [
                                                'value' => old('company'),
                                                'type' => 'text', 'name' => 'company',
                                                'placeholder' => trans('general.company') . '(' . trans('general.optional') . ')'
                                                ])
                                            @endcomponent
                                            @component('components.input', [
                                                'value' => old('address'),
                                                'type' => 'text', 'name' => 'address',
                                                'placeholder' => trans('general.address') . '*'
                                                ])
                                            @endcomponent
                                            @component('components.input', [
                                                'value' => old('post_code'),
                                                'type' => 'text', 'name' => 'post_code',
                                                'placeholder' => trans('general.post_code') . '*'
                                                ])
                                            @endcomponent
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'city',
                                                    'value' => old('city'), 'class' => 'half',
                                                    'placeholder' => trans('general.city') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'country',
                                                    'value' => old('country'), 'class' => 'half',
                                                    'placeholder' => trans('general.country') . '*'
                                                    ])
                                                @endcomponent
                                            </div>
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'email', 'name' => 'email',
                                                    'value' => old('email'), 'class' => 'half',
                                                    'placeholder' => trans('general.email') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'phone',
                                                    'value' => old('phone'), 'class' => 'half',
                                                    'placeholder' => trans('general.phone') . '*'
                                                    ])
                                                @endcomponent
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
                                                'value' => old('shipping_address'),
                                                'type' => 'text', 'name' => 'shipping_address',
                                                'placeholder' => trans('general.address') . '*'
                                                ])
                                            @endcomponent
                                            @component('components.input', [
                                                'value' => old('shipping_post_code'),
                                                'type' => 'text', 'name' => 'shipping_post_code',
                                                'placeholder' => trans('general.post_code') . '*'
                                                ])
                                            @endcomponent
                                            <div class="group">
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'shipping_city',
                                                    'value' => old('shipping_city'), 'class' => 'half',
                                                    'placeholder' => trans('general.city') . '*'
                                                    ])
                                                @endcomponent
                                                @component('components.input', [
                                                    'type' => 'text', 'name' => 'shipping_country',
                                                    'value' => old('shipping_country'), 'class' => 'half',
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
                                                <p>Thomas Albert</p>
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
                                                <p>Thomas Albert</p>
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
                                                    <h1>{{ mb_strtoupper(trans('general.products')) }}</h1>
                                                    <h2>{{ mb_strtoupper(trans('general.total')) }}</h2>
                                                    @foreach($carted_products as $carted_product)
                                                        <h3>
                                                            {{ $carted_product->pivot->quantity }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $carted_product->format_name }}
                                                            @if($carted_product->is_a_discount)
                                                                <span>
                                                                    <i class="old">{{ money_currency($carted_product->cart_line_value) }}</i>
                                                                    {{ money_currency($carted_product->cart_discount_line_value) }}
                                                                </span>
                                                            @else
                                                                <span>{{ money_currency($carted_product->cart_line_value) }}</span>
                                                            @endif
                                                        </h3>
                                                    @endforeach
                                                </div>
                                                <div class="final-total">
                                                    <h4>@lang('general.sub_total') <span>{{ money_currency($cartService->getSubTotal()) }}</span></h4>
                                                    <h4>@lang('general.tva')({{ $cartService->getTVAPercentage() }}%) <span>{{ money_currency($cartService->getTVA()) }}</span></h4>
                                                    <h4>@lang('general.coupon'){{ $cartService->getCouponCode() }} <span> - {{ money_currency($cartService->getCouponDiscount()) }}</span></h4>
                                                    <h5>@lang('general.big_total') <span>{{ money_currency($cartService->getBigTotal()) }}</span></h5>
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
                <form id="place-order" method="POST" class="hidden"
                    action="{{ locale_route('checkout.order') }}">
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