@inject('orderService', 'App\Services\OrderService')
@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_oder')))
@section('overlay_text', trans('general.my_oder'))
@section('overlay_font', font('copy'))

@section('app.home.body')
    <!--Start Cart Area-->
    <section class="cart-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <h2>
                            <strong class="text-theme">N° {{ $order->reference }}</strong> -
                            <strong class="{{ $order->format_status->label_color }}">
                                {{ mb_strtoupper($order->format_status->label) }}
                            </strong>
                        </h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table wishlist-table table-hover">
                            <thead class="table-title">
                            <tr>
                                <th class="produ text-uppercase">@lang('general.product')</th>
                                <th class="namedes text-uppercase">@lang('general.name') &amp; @lang('general.description')</th>
                                <th class="unit text-uppercase">@lang('general.price')</th>
                                <th class="quantity text-uppercase">@lang('general.quantity')</th>
                                <th class="valu text-uppercase">@lang('general.value')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr class="table-info">
                                    <td class="produ">
                                        <a href="{{ locale_route('products.show', [$product]) }}"
                                           class="{{ $product->stock === 0 ? 'out-of-stock' : '' }}">
                                            <img alt="..." src="{{ $product->image_path }}">
                                        </a>
                                    </td>
                                    <td class="namedes">
                                        <h2>
                                            <a href="{{ locale_route('products.show', [$product]) }}">
                                                {{ $product->format_name }}
                                            </a>
                                        </h2>
                                        <p>{{ $product->format_description }}</p>
                                    </td>
                                    <td class="unit">
                                        @if($product->is_a_discount)
                                            <span class="old">{{ money_currency($product->amount) }}</span>
                                            <br />
                                            <h5 class="new">{{ money_currency($product->new_price) }}</h5>
                                        @else
                                            <h5>{{ money_currency($product->amount) }}</h5>
                                        @endif
                                    </td>
                                    <td class="quantity">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="unit">
                                        @if($product->is_a_discount)
                                            <span class="old">{{ money_currency($product->cart_line_value) }}</span>
                                            <br />
                                            <h5 class="new">{{ money_currency($product->cart_discount_line_value) }}</h5>
                                        @else
                                            <h5>{{ money_currency($product->cart_line_value) }}</h5>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="total fix">
                        <div class="row cart-oveview-line">
                            <div class="col-xs-6">
                                @lang('general.sub_total')
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>
                                    {{ money_currency($orderService->getSubTotal($order)) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row cart-oveview-line">
                            <div class="col-xs-6">
                                @lang('general.tva') ({{ $orderService->getTVAPercentage() }}%)
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>
                                    {{ money_currency($orderService->getTVA($order)) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row cart-oveview-line">
                            <div class="col-xs-6">
                                @lang('general.coupon')
                            </div>
                            <div class="col-xs-6 text-right">
                                <strong>
                                    - {{ money_currency($order->discount) }}
                                </strong>
                            </div>
                        </div>
                        <div class="row text-theme h3">
                            <div class="col-xs-6">
                                @lang('general.big_total')
                            </div>
                            <div class="col-xs-6 text-right">
                                {{ money_currency($orderService->getBigTotal($order)) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-7 contact-form">
                    <div class="coupon">
                        <div class="float-right">
                            <a id="procedto" href="{{ locale_route('orders.index') }}">
                                <i class="{{ font('copy') }}"></i>
                                @lang('general.back_to_orders')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Cart Area-->
@endsection