@inject('orderService', 'App\Services\OrderService')
@extends('admin.layouts.admin')

@section('home.title', page_title('Commandes'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('copy') }}"></i>
                        COMMANDES
                    </h4>
                    <p class="card-description">
                        Filtrer les commandes
                    </p>
                    <div>
                        @component('admin.components.filter-button', [
                            'route' => route('admin.orders.index') . '?type=' . \App\Models\Order::ORDERED,
                            'icon' => 'file', 'label' => 'Commandé'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                            'route' => route('admin.orders.index') . '?type=' . \App\Models\Order::PROGRESS,
                            'icon' => 'cogs', 'label' => 'En traitement', 'class' => 'btn btn-success'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                           'route' => route('admin.orders.index') . '?type=' . \App\Models\Order::SOLD,
                           'icon' => 'check', 'label' => 'Livré', 'class' => 'btn btn-info'
                           ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                           'route' => route('admin.orders.index') . '?type=' . \App\Models\Order::CANCELED,
                           'icon' => 'times', 'label' => 'Annulé', 'class' => 'btn btn-danger'
                           ])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            @component('admin.components.table-card', [
                'table_label' => $table_label,
                'paginationTools' => $paginationTools,
                'headers' => ['reference', 'montant', 'statut', 'adresse', 'date']
                ])
                @forelse($paginationTools->displayItems as $order)
                    <tr class="{{ $order->format_status->label_color }}">
                        <td>{{ $order->reference }}</td>
                        <td class="text-right">{{ money_currency($orderService->getBigTotal($order)) }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar {{ $order->format_status->progress_bar_color  }}" role="progressbar" style="width: {{ $order->format_status->percentage }}%" aria-valuenow="{{ $order->format_status->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="order-status text-center">
                                <label class="badge {{ $order->format_status->badge_color }}">{{ $order->format_status->label }}</label>
                            </div>
                        </td>
                        <td class="text-center">
                            <p>
                                {{ text_format($order->shipping_address, 30) }} <br />
                                {{ text_format($order->shipping_post_code, 10) }}
                                {{ text_format($order->shipping_city, 15) }}
                                {{ text_format($order->shipping_country, 20) }}
                            </p>
                        </td>
                        <td class="text-center">{{ $order->created_date }} à {{ $order->created_time }}</td class="text-ce">
                        <td class="text-right">
                            @if($order->status === \App\Models\Order::ORDERED)
                                @component('components.modal-button', [
                                   'target' => 'progress-order-' . $order->id,
                                   'title' => 'Valider cette commande', 'icon' => 'cogs',
                                   'label' => '', 'class' => 'btn btn-success btn-icons btn-rounded'
                                ])
                                @endcomponent
                            @elseif($order->status === \App\Models\Order::PROGRESS)
                                @component('components.modal-button', [
                                    'target' => 'sold-order-' . $order->id,
                                    'title' => 'Terminer cette commande', 'icon' => 'check',
                                    'label' => '', 'class' => 'btn btn-info btn-icons btn-rounded'
                                ])
                                @endcomponent
                            @endif
                            @component('admin.components.details-button',
                               ['route' => route('admin.orders.show', [$order])])
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 6, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $order)
        @if($order->status === \App\Models\Order::ORDERED)
            @component('components.modal', [
                'title' => 'Valider la commande', 'method' => 'POST',
                'id' => 'progress-order-' . $order->id, 'color' => 'success',
                'action_route' => route('admin.orders.progress', [$order])
                ])
                Etes-vous sûr de vouloir valider la commande {{ $order->reference }}?
            @endcomponent
        @elseif($order->status === \App\Models\Order::PROGRESS)
            @component('components.modal', [
                'title' => 'Livrer la commande', 'method' => 'POST',
                'id' => 'sold-order-' . $order->id, 'color' => 'info',
                'action_route' => route('admin.orders.sold', [$order])
                ])
                Etes-vous sûr de vouloir livrer la commande {{ $order->reference }}?
            @endcomponent
        @endif
    @endforeach
@endsection