@inject('orderService', 'App\Services\OrderService')
@extends('admin.layouts.admin')

@section('home.title', 'Commandes')

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commandes</h4>
                    <p class="card-description">
                        Filtrer les commandes
                    </p>
                    <div>
                        <a href="{{ route('admin.orders.index') . '?type=' . \App\Models\Order::ORDERED }}"
                           class="btn btn-theme">
                            <i class="{{ font('file') }}"></i>
                            Commandé
                        </a>
                        <a href="{{ route('admin.orders.index') . '?type=' . \App\Models\Order::PROGRESS }}"
                           class="btn btn-success">
                            <i class="{{ font('cogs') }}"></i>
                            En traitement
                        </a>
                        <a href="{{ route('admin.orders.index') . '?type=' . \App\Models\Order::SOLD }}"
                           class="btn btn-primary">
                            <i class="{{ font('check') }}"></i>
                            Livré
                        </a>
                        <a href="{{ route('admin.orders.index') . '?type=' . \App\Models\Order::CANCELED }}"
                           class="btn btn-danger">
                            <i class="{{ font('times') }}"></i>
                            Annulé
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
                    <h4 class="card-title">{{ $table_label }}</h4>
                    @component('components.pagination',
                        ['paginationTools' => $paginationTools])
                    @endcomponent
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Reférence</th>
                                    <th>Produits</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Adresse</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paginationTools->displayItems as $order)
                                    <tr class="{{ $order->format_status->label_color }}">
                                        <td>{{ $order->reference }}</td>
                                        <td class="text-right">{{ $orderService->getProductsNumber($order) }}</td>
                                        <td class="text-right">{{ money_currency($orderService->getBigTotal($order)) }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped {{ $order->format_status->progress_bar_color  }}" role="progressbar" style="width: {{ $order->format_status->percentage }}%" aria-valuenow="{{ $order->format_status->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="order-status text-center">
                                                <label class="badge {{ $order->format_status->badge_color }}">{{ $order->format_status->label }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            <p>
                                                {{ $order->shipping_address }} <br />
                                                {{ $order->shipping_post_code }} {{ $order->shipping_city }} {{ $order->shipping_country }}
                                            </p>
                                        </td>
                                        <td>
                                            @if($order->status === \App\Models\Order::ORDERED)
                                                <button type="button" class="btn btn-success btn-icons btn-rounded" title="Valider cette commander"
                                                        data-toggle="modal" data-target="#progress-order-{{ $order->id }}">
                                                    <i class="{{ font('cogs') }}"></i>
                                                </button>
                                            @elseif($order->status === \App\Models\Order::PROGRESS)
                                                <button type="button" class="btn btn-primary btn-icons btn-rounded" title="Terminer cette commande"
                                                        data-toggle="modal" data-target="#sold-order-{{ $order->id }}">
                                                    <i class="{{ font('check') }}"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('admin.orders.show', [$order]) }}" class="btn btn-secondary btn-icons btn-rounded" title="Voir le détails">
                                                <i class="{{ font('eye') }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-info text-center">
                                                Pas de {{ mb_strtolower($table_label) }} pour le momment
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
                'id' => 'sold-order-' . $order->id, 'color' => 'primary',
                'action_route' => route('admin.orders.sold', [$order])
                ])
                Etes-vous sûr de vouloir livrer la commande {{ $order->reference }}?
            @endcomponent
        @endif
    @endforeach
@endsection