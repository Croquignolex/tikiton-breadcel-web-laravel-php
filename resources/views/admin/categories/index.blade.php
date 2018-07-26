@extends('admin.layouts.admin')

@section('home.title', page_title('Catégories'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('balance-scale') }}"></i>
                        CATEGORIES
                        @component('admin.components.add-button',
                           ['route' => route('admin.categories.create')])
                        @endcomponent
                    </h4>
                    <p class="card-description">
                        Filtrer les catégories
                    </p>
                    <div>
                        @component('admin.components.filter-button', [
                            'route' => route('admin.categories.index') . '?type=' . \App\Models\ProductCategory::HAS_PRODUCTS,
                            'icon' => 'folder', 'label' => 'Qui ont des produits'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                           'route' => route('admin.categories.index') . '?type=' . \App\Models\ProductCategory::HAS_NO_PRODUCTS,
                           'icon' => 'folder-open', 'label' => 'Qui n\'ont pas des produits', 'class' => 'btn btn-danger'
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
                'headers' => ['nom (fr)', 'nom (en)', 'description (fr)', 'description (en)', 'produits']
                ])
                @forelse($paginationTools->displayItems as $category)
                    <tr class="{{ $category->products->isEmpty() ? 'text-danger' : '' }}">
                        <td>{{ text_format($category->fr_name, 15) }}</td>
                        <td>{{ text_format($category->en_name, 15) }}</td>
                        <td>{{ text_format($category->fr_description, 20) }}</td>
                        <td>{{ text_format($category->en_description, 20) }}</td>
                        <td class="text-right">{{ $category->products->count() }}</td>
                        <td class="text-right">
                            @component('admin.components.update-button', [
                                'route' => route('admin.categories.edit', [$category]),
                                'title' => 'Modifier cette catégorie',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                               ['route' => route('admin.categories.show', [$category])])
                            @endcomponent
                            @if($category->products->isEmpty())
                                @component('admin.components.delete-button', [
                                    'target' => 'delete-category-' . $category->id,
                                    'title' => 'Supprimer cette catégorie',
                                    'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                    ])
                                @endcomponent
                            @endif
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

    @foreach($paginationTools->displayItems as $category)
        @if($category->products->isEmpty())
            @component('components.modal', [
                'title' => 'Supprimer la categories',
                'id' => 'delete-category-' . $category->id, 'color' => 'danger',
                'action_route' => route('admin.categories.destroy', [$category])
                ])
                Etes-vous sûr de vouloir supprimer {{ text_format($category->format_name, 50) }}?
            @endcomponent
        @endif
    @endforeach
@endsection
