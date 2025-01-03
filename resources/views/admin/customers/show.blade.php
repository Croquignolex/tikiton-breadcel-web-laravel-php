@extends('admin.layouts.admin')

@section('home.title', page_title($user->format_first_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($user->format_full_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.customers.index'),
                            'label' => 'Liste des clients'
                            ])
                        @endcomponent
                        @if($user->is_confirmed)
                            @component('components.modal-button', [
                               'target' => 'disable-customer',
                               'title' => 'Désactiver ce client', 'icon' => 'thumbs-down',
                               'label' => 'Désactiver', 'class' => 'btn btn-danger'
                               ])
                            @endcomponent
                        @else
                            @component('components.modal-button', [
                               'target' => 'enable-customer',
                               'title' => 'Activer ce client', 'icon' => 'thumbs-up',
                               'label' => 'Activer', 'class' => 'btn btn-success'
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
                <div class="card-body row text-secondary">
                    <div class="col-sm-5 side-bar-item">Email</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->email }}</div>
                    <div class="col-sm-5 side-bar-item">NOM</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->format_first_name }}</div>
                    <div class="col-sm-5 side-bar-item">Prénom</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->format_last_name }}</div>
                    <div class="col-sm-5 side-bar-item">Tel</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->phone }}</div>
                    <div class="col-sm-5 side-bar-item">Adresse</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->address }}</div>
                    <div class="col-sm-5 side-bar-item">Code potal</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->post_code }}</div>
                    <div class="col-sm-5 side-bar-item">Ville</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->city }}</div>
                    <div class="col-sm-5 side-bar-item">Pays</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->country }}</div>
                    <div class="col-sm-5 side-bar-item">Compagnie</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->company }}</div>
                    <div class="col-sm-5 side-bar-item">Statut</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        @if($user->is_confirmed)
                            <label class="badge badge-success">
                                <i class="{{ font('thumbs-up') }}"></i>
                                Confirmé
                            </label>
                        @else
                            <label class="badge badge-danger">
                                <i class="{{ font('thumbs-down') }}"></i>
                                Non confirmé
                            </label>
                        @endif
                    </div>
                    <div class="col-sm-5 side-bar-item">Commandes ({{ $user->orders->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($user->orders as $order)
                                <a href="{{ route('admin.orders.show', [$order]) }}" title="Appartient à ce client">
                                    <label class="badge badge-primary">
                                        <i class="{{ font('copy') }}"></i>
                                        {{ $order->reference }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce client n'a pas encore passé de commande
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Avis ({{ $user->reviewed_products->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($user->reviewed_products as $product)
                                <a href="{{ route('admin.products.show', [$product]) }}" title="{{ $product->format_name }}: {{ $product->pivot->text }}">
                                    <label class="badge badge-danger">
                                        <i class="{{ font('star') }}"></i>
                                        {{ $product->pivot->ranking / 2 }}/5
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce client n'a pas encore émis son avis sur un produit
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Favoris ({{ $user->wished_products->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($user->wished_products as $product)
                                <a href="{{ route('admin.products.show', [$product]) }}" title="Dans sa liste de favoris">
                                    <label class="badge badge-warning">
                                        <i class="{{ font('heart') }}"></i>
                                        {{ $product->format_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce client n'a pas de produits dans sa liste de favoris
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Paniers ({{ $user->carted_products->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($user->carted_products as $product)
                                <a href="{{ route('admin.products.show', [$product]) }}" title="Dans son panier">
                                    <label class="badge badge-info">
                                        <i class="{{ font('shopping-cart') }}"></i>
                                        {{ $product->format_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce client n'a pas de produits dans son panier
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Coupons ({{ $user->coupons->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($user->coupons as $coupon)
                                <a href="{{ route('admin.coupons.show', [$coupon]) }}"
                                   title="{{ $coupon->pivot->is_activated ? 'Peut être utilisé par ce client' : 'Ne peut plus être utilisé par ce client'}}">
                                    <label class="badge badge-dark">
                                        <i class="{{ font('barcode') }}"></i>
                                        {{ $coupon->code }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce client n'a pas de coupon promotionnel
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->created_date }} à {{ $user->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->updated_date }} à {{ $user->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @if($user->is_confirmed)
        @component('components.modal', [
           'title' => 'Desactive le client', 'method' => 'POST',
           'id' => 'disable-customer', 'color' => 'danger',
           'action_route' => route('admin.customers.disable', [$user])
           ])
            Etes-vous sûr de vouloir désactiver {{ text_format($user->format_full_name, 50) }}?
        @endcomponent
    @else
        @component('components.modal', [
            'title' => 'Activer le client', 'method' => 'PUT',
            'id' => 'enable-customer', 'color' => 'success',
            'action_route' => route('admin.customers.enable', [$user])
            ])
            Etes-vous sûr de vouloir activer {{ text_format($user->format_full_name, 50) }}?
        @endcomponent
    @endif
@endsection