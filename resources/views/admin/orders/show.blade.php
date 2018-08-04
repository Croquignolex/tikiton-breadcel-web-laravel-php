@inject('orderService', 'App\Services\OrderService')
@extends('admin.layouts.admin')

@section('home.title', page_title($order->reference))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAILS DE {{ $order->reference }} -
                        <strong class="{{ $order->format_status->label_color }}">
                            {{ mb_strtoupper($order->format_status->label) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.orders.index'),
                            'label' => 'Liste des commandes'
                            ])
                        @endcomponent
                        @if($order->status === \App\Models\Order::ORDERED)
                            @component('components.modal-button', [
                               'target' => 'progress-order',
                               'title' => 'Valider cette commande', 'icon' => 'cogs',
                               'label' => 'Valider', 'class' => 'btn btn-success'
                               ])
                            @endcomponent
                        @elseif($order->status === \App\Models\Order::PROGRESS)
                            @component('components.modal-button', [
                              'target' => 'sold-order',
                              'title' => 'Terminer cette commande', 'icon' => 'check',
                              'label' => 'Livrer', 'class' => 'btn btn-info'
                              ])
                            @endcomponent
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
                        <strong class="{{ $order->format_status->label_color }}">Nom & Prénom:</strong>
                        <a href="{{ route('admin.customers.show', [ $order->user])}}">{{ $order->user->format_full_name }}</a><br />
                        <strong class="{{ $order->format_status->label_color }}">Email:</strong> {{ $order->user->email }}<br />
                        <strong class="{{ $order->format_status->label_color }}">Tel:</strong> {{ $order->user->phone }}<br />
                        <strong class="{{ $order->format_status->label_color }}">Commande N°:</strong> {{ $order->reference }}<br />
                        <strong class="{{ $order->format_status->label_color }}">Date de commande:</strong> {{ $order->created_date }} à {{ $order->created_time }}
                        @if($order->status === \App\Models\Order::PROGRESS)
                            <br /><strong class="{{ $order->format_status->label_color }}">Date de confirmation:</strong> {{ $order->updated_date }} à {{ $order->updated_time }}
                        @elseif($order->status === \App\Models\Order::SOLD)
                            <br /><strong class="{{ $order->format_status->label_color }}">Date de livraison:</strong> {{ $order->updated_date }} à {{ $order->updated_time }}
                        @elseif($order->status === \App\Models\Order::CANCELED)
                            <br /><strong class="{{ $order->format_status->label_color }}">Date d'annulation:</strong> {{ $order->updated_date }} à {{ $order->updated_time }}
                        @endif                    </p>
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