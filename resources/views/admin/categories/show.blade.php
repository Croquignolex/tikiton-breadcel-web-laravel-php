@extends('admin.layouts.admin')

@section('home.title', page_title($category->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($category->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.categories.index'),
                            'label' => 'Liste des catégories'
                            ])
                        @endcomponent
                        @component('admin.components.update-button', [
                            'route' => route('admin.categories.edit', [$category]),
                            'title' => 'Modifier cette catégorie'
                            ])
                        @endcomponent
                        @if($category->products->isEmpty())
                            @component('admin.components.delete-button', [
                                'target' => 'delete-category',
                                'title' => 'Supprimer cette catégorie'
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
                    <div class="col-sm-5 side-bar-item">NOM(fr)</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $category->fr_name }}</div>
                    <div class="col-sm-5 side-bar-item">NOM(en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $category->en_name }}</div>
                    <div class="col-sm-5 side-bar-item">Description(fr)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $category->fr_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Description(en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $category->en_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Produits ({{ $category->products->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($category->products as $product)
                                <a href="{{ route('admin.products.show', [$product]) }}" title="Appartient à cette catégorie">
                                    <label class="badge badge-theme">
                                        <i class="{{ font('database') }}"></i>
                                        {{ $product->format_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Cette catégories n'a aucun produit
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $category->created_date }} à {{ $category->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $category->updated_date }} à {{ $category->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @if($category->products->isEmpty())
        @component('components.modal', [
            'title' => 'Supprimer la catégorie',
            'id' => 'delete-category', 'color' => 'danger',
            'action_route' => route('admin.categories.destroy', [$category])
            ])
            Etes-vous sûr de vouloir supprimer {{ text_format($category->format_name, 50) }}?
        @endcomponent
    @endif
@endsection