@inject('orderService', 'App\Services\OrderService')
@extends('admin.layouts.admin')

@section('home.title', 'Commande ' . $order->reference)

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Commandes {{ $order->reference }} -
                        <strong class="{{ $order->format_status->label_color }}">
                            {{ mb_strtoupper($order->format_status->label) }}
                        </strong>
                    </h4>
                    <div>
                        <a href="{{ route('admin.orders.index') }}"
                           class="btn btn-theme">
                            <i class="{{ font('arrow-left') }}"></i>
                            Retour à la liste des commandes
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p>
                        <strong class="{{ $order->format_status->label_color }}">Nom & Prénom:</strong> {{ $order->user->format_full_name }}<br />
                        <strong class="{{ $order->format_status->label_color }}">Email:</strong> {{ $order->user->email }}<br />
                        <strong class="{{ $order->format_status->label_color }}">Tel:</strong> {{ $order->user->phone }}<br />
                        <strong class="{{ $order->format_status->label_color }}">Commande N°:</strong> {{ $order->reference }}
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="{{ $order->format_status->progress_bar_color }} text-white">
                                    <th>Nom</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <th>{{ $product->fr_name }}</th>
                                        <th class="text-right">
                                            @if($product->is_a_discount)
                                                <i style="text-decoration: line-through;">{{ money_currency($product->fr_amount) }}</i>
                                                {{ money_currency($product->fr_new_price) }}
                                            @else
                                                {{ money_currency($product->fr_amount) }}
                                            @endif
                                        </th>
                                        <th class="text-right">{{ $product->pivot->quantity }}</th>
                                        <th class="text-right">
                                            @if($product->is_a_discount)
                                                <i style="text-decoration: line-through;">{{ money_currency($product->fr_cart_line_value) }}</i>
                                                {{ money_currency($product->fr_cart_discount_line_value) }}
                                            @else
                                                {{ money_currency($product->fr_cart_line_value) }}
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"><strong>Sous total</strong></td>
                                    <td colspan="2" class="text-right"><strong>{{ money_currency($orderService->getFrSubTotal($order)) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>TVA ({{ $orderService->getTVAPercentage() }})</strong></td>
                                    <td colspan="2" class="text-right"><strong>{{ money_currency($orderService->getFrTVA($order)) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>Coupon</strong></td>
                                    <td colspan="2" class="text-right"><strong>- {{ money_currency($orderService->getFrDiscount($order)) }}</strong></td>
                                </tr>
                                <tr class="{{ $order->format_status->label_color }}">
                                    <td colspan="2"><strong>Grand total</strong></td>
                                    <td colspan="2" class="text-right"><strong>{{ money_currency($orderService->getFrBigTotal($order)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>
@endsection