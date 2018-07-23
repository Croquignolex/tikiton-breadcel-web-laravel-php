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
                        <button type="button" class="btn btn-danger" title="Supprimer ce produit"
                                data-toggle="modal" data-target="#delete-product">
                            <i class="{{ font('trash-o') }}"></i>
                            Supprimer
                        </button>
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
                    <div class="col-lg-7 text-dark side-bar-item">{{ $product->product_category->format_name }}</div>
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
                    <div class="col-lg-5 side-bar-item">Etiquette(s)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @foreach($product->tags as $tag)
                                <label class="badge badge-dark" title="Produit en vedette">
                                    <i class="{{ font('tag') }}"></i>
                                    {{ $tag->format_name }}
                                </label>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @component('components.modal', [
        'title' => 'Supprimer le produit',
        'id' => 'delete-product', 'color' => 'danger',
        'action_route' => route('admin.products.destroy', [$product])
        ])
        Etes-vous sûr de vouloir supprimer {{ $product->format_name }}?
    @endcomponent
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush