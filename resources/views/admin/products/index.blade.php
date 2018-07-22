@extends('admin.layouts.admin')

@section('home.title', page_title('Produits'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        PRODUITS
                        <a href="{{ route('admin.products.create') }}"
                           class="btn btn-secondary">
                            <i class="{{ font('plus') }}"></i>
                            Ajouter
                        </a>
                    </h4>
                    <p class="card-description">
                        Filtrer les produits
                    </p>
                    <div>
                        <a href="{{ route('admin.products.index') . '?type=' . \App\Models\Product::IS_FEATURED }}"
                           class="btn btn-theme">
                            <i class="{{ font('star') }}"></i>
                            En vedette
                        </a>
                        <a href="{{ route('admin.products.index') . '?type=' . \App\Models\Product::IS_BEST_SELLER }}"
                           class="btn btn-info">
                            <i class="{{ font('gift') }}"></i>
                            Meilleurs vente
                        </a>
                        <a href="{{ route('admin.products.index') . '?type=' . \App\Models\Product::IS_NEW }}"
                           class="btn btn-success">
                            <i class="{{ font('check') }}"></i>
                            Nouveaux
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
                    <h4 class="card-title">{{ mb_strtoupper($table_label) }} ({{ $paginationTools->displayItems->count() }} sur {{ $paginationTools->itemsNumber }})</h4>
                    @component('components.pagination',
                        ['paginationTools' => $paginationTools])
                    @endcomponent
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="table-secondary">
                                    <th>NOM (fr)</th>
                                    <th>NOM (en)</th>
                                    <th>STATUT</th>
                                    <th>PRIX</th>
                                    <th>PROMO</th>
                                    <th>STOCK</th>
                                    <th>CATEGORIE</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paginationTools->displayItems as $product)
                                    <tr class="{{ $product->availability === \App\Models\Product::OUT_OF_STOCK ? 'text-danger' : '' }}">
                                        <td>{{ text_format($product->fr_name, 30) }}</td>
                                        <td>{{ text_format($product->en_name, 30) }}</td>
                                        <td class="text-center">
                                            @if($product->created_at >= now()->addDay(-7) || $product->is_new)
                                                <label class="badge badge-success" title="Nouveau produit">
                                                    <i class="{{ font('check') }}"></i>
                                                </label>
                                            @endif
                                            @if($product->ranking === 10 || $product->is_featured)
                                                <label class="badge badge-theme" title="Produit en vedette">
                                                    <i class="{{ font('star') }}"></i>
                                                </label>
                                            @endif
                                            @if($product->is_most_sold)
                                                <label class="badge badge-info" title="Produit en meilleur vente">
                                                    <i class="{{ font('gift') }}"></i>
                                                </label>
                                            @endif
                                        </td>
                                        <td class="text-right">{{ money_currency($product->fr_amount) }}</td>
                                        <td class="text-right">{{ $product->discount }}%</td>
                                        <td class="text-right">{{ $product->stock }}</td>
                                        <td>{{ text_format($product->category->fr_name, 30) }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-warning btn-icons btn-rounded" title="Modifier le produit"
                                                href="{{ route('admin.products.edit', [$product]) }}">
                                                <i class="{{ font('pencil') }}"></i>
                                            </a>
                                            <a class="btn btn-primary btn-icons btn-rounded" title="Voir les détails"
                                               href="{{ route('admin.products.show', [$product]) }}">
                                                <i class="{{ font('eye') }}"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-icons btn-rounded" title="Supprimer ce produit"
                                                data-toggle="modal" data-target="#delete-product-{{ $product->id }}">
                                                <i class="{{ font('trash-o') }}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
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

    @foreach($paginationTools->displayItems as $product)
        @component('components.modal', [
            'title' => 'Supprimer le produit',
            'id' => 'delete-product-' . $product->id, 'color' => 'danger',
            'action_route' => route('admin.products.destroy', [$product])
            ])
            Etes-vous sûr de vouloir supprimer {{ $product->format_name }}?
        @endcomponent
    @endforeach
@endsection
