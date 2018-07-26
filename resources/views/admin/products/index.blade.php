@extends('admin.layouts.admin')

@section('home.title', page_title('Produits'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('database') }}"></i>
                        PRODUITS
                        @component('admin.components.add-button',
                           ['route' => route('admin.products.create')])
                        @endcomponent
                    </h4>
                    <p class="card-description">
                        Filtrer les produits
                    </p>
                    <div>
                        @component('admin.components.filter-button', [
                            'route' => route('admin.products.index') . '?type=' . \App\Models\Product::IS_FEATURED,
                            'icon' => 'star', 'label' => 'En vedette'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                            'route' => route('admin.products.index') . '?type=' . \App\Models\Product::IS_BEST_SELLER,
                            'icon' => 'gift', 'label' => 'Meilleurs vente', 'class' => 'btn btn-info'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                           'route' => route('admin.products.index') . '?type=' . \App\Models\Product::IS_NEW,
                           'icon' => 'check', 'label' => 'Nouveaux', 'class' => 'btn btn-success'
                           ])
                        @endcomponent
                            @component('admin.components.filter-button', [
                           'route' => route('admin.products.index') . '?type=' . \App\Models\Product::IS_OUT_OF_STOCK,
                           'icon' => 'remove', 'label' => 'Rupture de stock', 'class' => 'btn btn-danger'
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
                'headers' => ['nom (fr)', 'nom (en)', 'statut', 'prix', 'promo', 'stock', 'catégorie']
                ])
                @forelse($paginationTools->displayItems as $product)
                    <tr class="{{ $product->availability === \App\Models\Product::OUT_OF_STOCK ? 'text-danger' : '' }}">
                        <td>{{ text_format($product->fr_name, 15) }}</td>
                        <td>{{ text_format($product->en_name, 15) }}</td>
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
                        <td>{{ text_format($product->product_category->fr_name, 20) }}</td>
                        <td class="text-right">
                            @component('admin.components.update-button', [
                                'route' => route('admin.products.edit', [$product]),
                                'title' => 'Modifier ce produit',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                               ['route' => route('admin.products.show', [$product])])
                            @endcomponent
                            @if($product->orders->isEmpty())
                                @component('admin.components.delete-button', [
                                    'target' => 'delete-product-' . $product->id,
                                    'title' => 'Supprimer ce produit',
                                    'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                    ])
                                @endcomponent
                            @endif
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 8, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $product)
        @if($product->orders->isEmpty())
            @component('components.modal', [
                'title' => 'Supprimer le produit',
                'id' => 'delete-product-' . $product->id, 'color' => 'danger',
                'action_route' => route('admin.products.destroy', [$product])
                ])
                Etes-vous sûr de vouloir supprimer {{ text_format($product->format_name, 50) }}?
            @endcomponent
        @endif
    @endforeach
@endsection
