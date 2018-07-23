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
                        COMMANDE {{ $order->reference }} -
                        <strong class="{{ $order->format_status->label_color }}">
                            {{ mb_strtoupper($order->format_status->label) }}
                        </strong>
                    </h4>
                    <div>
                        <a href="{{ route('admin.orders.index') }}"
                           class="btn btn-theme">
                            <i class="{{ font('arrow-left') }}"></i>
                            Lliste des commandes
                        </a>
                        @if($order->status === \App\Models\Order::ORDERED)
                            <button type="button" class="btn btn-success" title="Valider cette commander"
                                    data-toggle="modal" data-target="#progress-order">
                                <i class="{{ font('cogs') }}"></i>
                                Valider
                            </button>
                        @elseif($order->status === \App\Models\Order::PROGRESS)
                            <button type="button" class="btn btn-info" title="Terminer cette commande"
                                    data-toggle="modal" data-target="#sold-order">
                                <i class="{{ font('check') }}"></i>
                                Livrer
                            </button>
                        @endif
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
                                    <th>NOM</th>
                                    <th>PRIX UNITAIRE</th>
                                    <th>QUANTITE</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td>
                                            <a title="Voir les détails" href="{{ route('admin.products.show', [$product]) }}">
                                                {{ $product->fr_name }}
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            @if($product->is_a_discount)
                                                <i style="text-decoration: line-through;">{{ money_currency($product->fr_amount) }}</i>
                                                {{ money_currency($product->fr_new_price) }}
                                            @else
                                                {{ money_currency($product->fr_amount) }}
                                            @endif
                                        </td>
                                        <td class="text-right">{{ $product->pivot->quantity }}</td>
                                        <td class="text-right">
                                            @if($product->is_a_discount)
                                                <i style="text-decoration: line-through;">{{ money_currency($product->fr_cart_line_value) }}</i>
                                                {{ money_currency($product->fr_cart_discount_line_value) }}
                                            @else
                                                {{ money_currency($product->fr_cart_line_value) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="table-secondary">
                                    <td colspan="2"><strong>SOUS TOTAL</strong></td>
                                    <td colspan="2" class="text-right"><strong>{{ money_currency($orderService->getFrSubTotal($order)) }}</strong></td>
                                </tr>
                                <tr class="table-secondary">
                                    <td colspan="2"><strong>TVA ({{ $orderService->getTVAPercentage() }})</strong></td>
                                    <td colspan="2" class="text-right"><strong>{{ money_currency($orderService->getFrTVA($order)) }}</strong></td>
                                </tr>
                                <tr class="table-secondary">
                                    <td colspan="2"><strong>COUPON</strong></td>
                                    <td colspan="2" class="text-right"><strong>- {{ money_currency($orderService->getFrDiscount($order)) }}</strong></td>
                                </tr>
                                <tr class="{{ $order->format_status->label_color }} table-secondary">
                                    <td colspan="2"><strong>GRAND TOTAL</strong></td>
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

    @if($order->status === \App\Models\Order::ORDERED)
        @component('components.modal', [
            'title' => 'Valider la commande', 'method' => 'POST',
            'id' => 'progress-order', 'color' => 'success',
            'action_route' => route('admin.orders.progress', [$order])
            ])
            Etes-vous sûr de vouloir valider la commande {{ $order->reference }}?
        @endcomponent
    @elseif($order->status === \App\Models\Order::PROGRESS)
        @component('components.modal', [
            'title' => 'Livrer la commande', 'method' => 'POST',
            'id' => 'sold-order', 'color' => 'info',
            'action_route' => route('admin.orders.sold', [$order])
            ])
            Etes-vous sûr de vouloir livrer la commande {{ $order->reference }}?
        @endcomponent
    @endif
@endsection