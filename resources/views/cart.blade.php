@inject('cartService', 'App\Services\CartService')
@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_cart')))
@section('overlay_text', trans('general.cart'))
@section('overlay_font', font('shopping-cart'))

@section('app.home.body')
    <!--Start Cart Area-->
    <section class="cart-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead class="table-title">
                                <tr>
                                    <th class="produ">@lang('general.product')</th>
                                    <th class="namedes">@lang('general.name') &amp; @lang('general.description')</th>
                                    <th class="unit">@lang('general.price')</th>
                                    <th class="quantity">@lang('general.quantity')</th>
                                    <th class="valu">@lang('general.value')</th>
                                    <th class="valu">@lang('general.availability')</th>
                                    <th class="valu">@lang('general.wish_list')</th>
                                    <th class="acti">@lang('general.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($carted_products as $carted_product)
                                    <tr class="table-info">
                                        <td class="produ">
                                            <a href="{{ locale_route('products.show', [$carted_product]) }}"
                                               class="{{ $carted_product->stock === 0 ? 'out-of-stock' : '' }}">
                                                <img alt="..." src="{{ $carted_product->image_path }}">
                                            </a>
                                        </td>
                                        <td class="namedes">
                                            <h2>
                                                <a href="{{ locale_route('products.show', [$carted_product]) }}">
                                                    {{ $carted_product->format_name }}
                                                </a>
                                            </h2>
                                            <p>{{ $carted_product->format_description }}</p>
                                        </td>
                                        <td class="unit">
                                            @if($carted_product->is_a_discount)
                                                <span class="old">{{ money_currency($carted_product->amount) }}</span>
                                                <br />
                                                <h5 class="new">{{ money_currency($carted_product->new_price) }}</h5>
                                            @else
                                                <h5>{{ money_currency($carted_product->amount) }}</h5>
                                            @endif
                                        </td>
                                        <td class="quantity">
                                            <form action="{{ locale_route('cart.update', [$carted_product]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="cart-plus-minus">
                                                    <input type="text" name="quantity"
                                                           value="{{ $carted_product->pivot->quantity }}" @input="valueInRange">
                                                </div>
                                                <button class="btn btn-theme" type="submit" title="@lang('general.calculate')">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="unit">
                                            @if($carted_product->is_a_discount)
                                                <span class="old">{{ money_currency($carted_product->cart_line_value) }}</span>
                                                <br />
                                                <h5 class="new">{{ money_currency($carted_product->cart_discount_line_value) }}</h5>
                                            @else
                                                <h5>{{ money_currency($carted_product->cart_line_value) }}</h5>
                                            @endif
                                        </td>
                                        <td class="quantity {{ $carted_product->availability }}">
                                            @lang('general.' . $carted_product->availability)
                                        </td>
                                        <td class="valu">
                                            @if($carted_product->is_in_current_user_wish_list)
                                                <button class="btn btn-danger" title="@lang('general.remove_from_wish_list')" type="button"
                                                        onclick="document.getElementById('remove-product-{{ $carted_product->id }}').submit();">
                                                    <i class="{{ font('heart-o') }}"></i>
                                                    <small>
                                                        <i class="{{ font('sort-down') }}"></i>
                                                    </small>
                                                </button>
                                                <form id="remove-product-{{ $carted_product->id }}" method="POST" class="hidden"
                                                      action="{{ locale_route('account.remove.product.wishlist', [$carted_product]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @else
                                                <button class="btn btn-theme" title="@lang('general.add_to_wish_list')" type="button"
                                                        onclick="document.getElementById('add-product-{{ $carted_product->id }}').submit();">
                                                    <i class="{{ font('heart') }}"></i>
                                                    <small>
                                                        <i class="{{ font('sort-up') }}"></i>
                                                    </small>
                                                </button>
                                                <form id="add-product-{{ $carted_product->id }}" method="POST" class="hidden"
                                                      action="{{ locale_route('account.add.product.wishlist', [$carted_product]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                </form>
                                            @endif
                                        </td>
                                        <td class="acti">
                                            <button class="btn btn-danger" type="button" data-toggle="modal"
                                                    data-target="#remove-from-cart-{{ $carted_product->id }}"
                                                    title="@lang('general.remove_from_cart')">
                                                <i class="{{ font('trash-o') }}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="8">
                                            <div class="alert alert-info text-center">
                                                @lang('general.empty_cart')
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-7 contact-form">
                    <div class="coupon">
                        <h3>@lang('general.coupon_code')</h3>
                        <form action="{{ locale_route('coupon') }}" method="POST" @submit="validateFormElements">
                            {{ csrf_field() }}
                            @component('components.input', [
                                'type' => 'text', 'name' => 'coupon',
                                 'value' => old('coupon'), 'minlength' => 8,
                                 'maxlength' => 8
                                ])
                            @endcomponent
                            <div class="float-left">
                                @component('components.submit', [
                                    'class' => 'submit', 'value' => trans('general.apply'),
                                    'title' => trans('general.apply_your_coupon')
                                    ])
                                @endcomponent
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="proceed fix">
                        <a href="{{ locale_route('products.index') }}">
                            @lang('general.continue_shopping')
                        </a>
                        <a href="javascript: void(0);"
                           onclick="document.getElementById('remove-all-products').submit();"
                            class="delete-btn">
                            @lang('general.empty_your_cart')
                        </a>
                        <form id="remove-all-products" method="POST" class="hidden"
                              action="{{ locale_route('account.remove.product.cart.all') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </div>
                    <div class="total fix">
                        <div class="row cart-oveview-line">
                            <div class="col-xs-6">
                                @lang('general.sub_total')
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>
                                    {{ money_currency($cartService->getSubTotal()) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row cart-oveview-line">
                            <div class="col-xs-6">
                                @lang('general.tva') ({{ $cartService->getTVAPercentage() }}%)
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>
                                    {{ money_currency($cartService->getTVA()) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row cart-oveview-line">
                            <div class="col-xs-6">
                                @lang('general.coupon') {{ $cartService->getCouponCode() }}
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>
                                    - {{ money_currency($cartService->getCouponDiscount()) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row text-theme h3">
                            <div class="col-xs-6">
                                @lang('general.big_total')
                            </div>
                            <div class="col-xs-6 text-right">
                                {{ money_currency($cartService->getBigTotal()) }}
                            </div>
                        </div>
                    </div>
                    @if(!$carted_products->isEmpty())
                        <a id="procedto" href="{{ locale_route('checkout.index') }}">
                            @lang('general.proceed_checkout')
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--End Cart Area-->

    @foreach($carted_products as $carted_product)
        @component('components.modal', [
        'title' => trans('general.remove_from_cart'),
            'id' => 'remove-from-cart-' . $carted_product->id, 'color' => 'danger',
            'action_route' => locale_route('account.remove.product.cart', [$carted_product])
            ])
            @lang('general.remove_product_from_cart', ['product' => $carted_product->format_name]) ?
        @endcomponent
    @endforeach
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
@endpush