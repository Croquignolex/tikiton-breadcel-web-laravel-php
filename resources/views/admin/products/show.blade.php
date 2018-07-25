@extends('admin.layouts.admin')

@section('home.title', page_title($product->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($product->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-theme">
                            <i class="{{ font('arrow-left') }}"></i>
                            Liste des produits
                        </a>
                        <a class="btn btn-warning" title="Modifier ce produit"
                           href="{{ route('admin.products.edit', [$product]) }}">
                            <i class="{{ font('pencil') }}"></i>
                            Modifier
                        </a>
                        @if($product->orders->isEmpty())
                            <button type="button" class="btn btn-danger" title="Supprimer ce produit"
                                    data-toggle="modal" data-target="#delete-product">
                                <i class="{{ font('trash-o') }}"></i>
                                Supprimer
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-5 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <img src="{{ $product->image_path }}" alt="..." class="img-fluid">
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body row text-secondary">
                    <div class="col-lg-5 side-bar-item">NOM(fr)</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $product->fr_name }}</div>
                    <div class="col-lg-5 side-bar-item">NOM(en)</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $product->en_name }}</div>
                    <div class="col-lg-5 side-bar-item">Prix</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ money_currency($product->amount) }}</div>
                    <div class="col-lg-5 side-bar-item">Réduction (Promo)%</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $product->discount }}</div>
                    <div class="col-lg-5 side-bar-item">Stock</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $product->stock }}</div>
                    <div class="col-lg-5 side-bar-item">Categorie</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <a href="{{ route('admin.categories.show', [$product->product_category]) }}">
                            {{ $product->product_category->format_name }}
                        </a>
                    </div>
                    <div class="col-lg-5 side-bar-item">Description(fr)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $product->fr_description }}
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Description(en)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $product->en_description }}
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Statut(s)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @if($product->created_at >= now()->addDay(-7) || $product->is_new)
                                <label class="badge badge-success" title="Nouveau produit">
                                    <i class="{{ font('check') }}"></i>
                                    Nouveau
                                </label>
                            @endif
                            @if($product->ranking === 10 || $product->is_featured)
                                <label class="badge badge-theme" title="Produit en vedette">
                                    <i class="{{ font('star') }}"></i>
                                    En vedette
                                </label>
                            @endif
                            @if($product->is_most_sold)
                                <label class="badge badge-info" title="Produit en meilleur vente">
                                    <i class="{{ font('gift') }}"></i>
                                    Meilleur vente
                                </label>
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Etiquettes ({{ $product->tags->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @forelse($product->tags as $tag)
                                <a href="{{ route('admin.tags.show', [$tag]) }}" title="Rattachée à ce produit">
                                    <label class="badge badge-dark">
                                        <i class="{{ font('tags') }}"></i>
                                        {{ $tag->format_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Pas d'étiquette(s) rattachée(s) à ce produit
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Commandes ({{ $product->orders->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @forelse($product->orders as $order)
                                <a href="{{ route('admin.orders.show', [$order]) }}" title="Contient ce produit">
                                    <label class="badge badge-primary">
                                        <i class="{{ font('copy') }}"></i>
                                        {{ $order->reference }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce produit ne figure dans aucune commande
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Avis ({{ $product->product_reviews->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @forelse($product->reviewed_users as $user)
                                <a href="{{ route('admin.customers.show', [$user]) }}" title="{{ $user->format_full_name }}: {{ $user->pivot->text }}">
                                    <label class="badge badge-danger">
                                        <i class="{{ font('star') }}"></i>
                                        {{ $user->pivot->ranking / 2 }}/5
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce produit n'a pas encore été commenté et noté
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Favoris ({{ $product->wished_users->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @forelse($product->wished_users as $user)
                                <a href="{{ route('admin.customers.show', [$user]) }}" title="Dans sa liste de favoris">
                                    <label class="badge badge-warning">
                                        <i class="{{ font('heart') }}"></i>
                                        {{ $user->format_full_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Aucun client n'a mis ce produit dans sa liste de favoris
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Paniers ({{ $product->carted_users->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @forelse($product->carted_users as $user)
                                <a href="{{ route('admin.customers.show', [$user]) }}" title="Dans son panier">
                                    <label class="badge badge-theme">
                                        <i class="{{ font('shopping-cart') }}"></i>
                                        {{ $user->format_full_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Aucun client n'a mis ce produit dans son panier
                                </strong>
                            @endforelse
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @if($product->orders->isEmpty())
        @component('components.modal', [
            'title' => 'Supprimer le produit',
            'id' => 'delete-product', 'color' => 'danger',
            'action_route' => route('admin.products.destroy', [$product])
            ])
            Etes-vous sûr de vouloir supprimer {{ text_format($product->format_name, 50) }}?
        @endcomponent
    @endif
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush