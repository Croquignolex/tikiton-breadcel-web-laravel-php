@inject('orderService', 'App\Services\OrderService')
@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_orders')))
@section('overlay_text', trans('general.orders'))
@section('overlay_font', font('copy'))

@section('app.home.body')
    <!--Start Wishlist Area-->
    <section class="wishlist-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table wishlist-table table-hover">
                            <thead class="table-title">
                                <tr>
                                    <th class="produ text-uppercase">@lang('general.reference')</th>
                                    <th class="unit text-uppercase">@lang('general.products')</th>
                                    <th class="unit text-uppercase">@lang('general.amount')</th>
                                    <th class="unit text-uppercase">@lang('general.status')</th>
                                    <th class="unit">@lang('general.address')</th>
                                    <th class="namedes text-center">@lang('general.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr class="table-info">
                                        <td class="produ {{ $order->format_status->label_color }}">
                                            {{ $order->reference }}
                                        </td>
                                        <td class="quantity text-right">
                                            {{ $orderService->getProductsNumber($order) }}
                                        </td>
                                        <td class="quantity">
                                            <strong>
                                                {{ money_currency($orderService->getBigTotal($order)) }}
                                            </strong>
                                        </td>
                                        <td class="quantity {{ $order->format_status->label_color }}">
                                            {{ $order->format_status->label }}
                                            <div class="progress status-progress">
                                                <div class="progress-bar progress-bar-striped active {{ $order->format_status->progress_bg_color }}" role="progressbar" style="width: {{ $order->format_status->percentage }}%;" aria-valuenow="{{ $order->format_status->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="quantity">
                                            <p>
                                                {{ $order->shipping_address }} <br />
                                                {{ $order->shipping_post_code }} {{ $order->shipping_city }} {{ $order->shipping_country }}
                                            </p>
                                        </td>
                                        <td class="namedes text-center">
                                            @if($order->status === \App\Models\Order::ORDERED)
                                                <button type="button" class="btn btn-danger" title="@lang('general.cancel_order')"
                                                    data-toggle="modal" data-target="#cancel-order-{{ $order->id }}">
                                                    <i class="{{ font('remove') }}"></i>
                                                    @lang('general.cancel')
                                                </button>
                                            @elseif($order->status === \App\Models\Order::CANCELED)
                                                <button type="button" class="btn btn-theme" title="@lang('general.order_back')"
                                                    data-toggle="modal" data-target="#order-{{ $order->id }}">
                                                    <i class="{{ font('check') }}"></i>
                                                    @lang('general.order')
                                                </button>
                                            @endif
                                            <a href="{{ locale_route('orders.show', [$order]) }}" class="btn btn-default" title="@lang('general.view_order_details')">
                                                <i class="{{ font('eye') }}"></i>
                                                @lang('general.details')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="6">
                                            <div class="alert alert-info text-center">
                                                @lang('general.empty_order')
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Wishlist Area-->

    @foreach($orders as $order)
        @if($order->status === \App\Models\Order::ORDERED)
            @component('components.modal', [
                'title' => trans('general.cancel_order'),
                'id' => 'cancel-order-' . $order->id, 'color' => 'danger',
                'action_route' => locale_route('order.cancel', [$order])
                ])
                @lang('general.cancel_your_order', ['order' => $order->reference]) ?
            @endcomponent
        @elseif($order->status === \App\Models\Order::CANCELED)
            @component('components.modal', [
                'method' => 'PUT',
                'title' => trans('general.order_back'),
                'id' => 'order-' . $order->id, 'color' => 'theme',
                'action_route' => locale_route('order.order', [$order])
                ])
                @lang('general.order_your_back', ['order' => $order->reference]) ?
            @endcomponent
        @endif
    @endforeach
@endsection