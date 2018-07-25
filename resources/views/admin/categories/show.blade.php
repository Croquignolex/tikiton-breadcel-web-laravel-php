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
                        <a href="{{ route('admin.categories.index') }}"
                           class="btn btn-theme">
                            <i class="{{ font('arrow-left') }}"></i>
                            Liste des catégories
                        </a>
                        <a class="btn btn-warning" title="Modifier cette catégorie"
                           href="{{ route('admin.categories.edit', [$category]) }}">
                            <i class="{{ font('pencil') }}"></i>
                            Modifier
                        </a>
                        @if($category->products->isEmpty())
                            <button type="button" class="btn btn-danger" title="Supprimer cette catégorie"
                                    data-toggle="modal" data-target="#delete-category">
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body row text-secondary">
                    <div class="col-lg-5 side-bar-item">NOM(fr)</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $category->fr_name }}</div>
                    <div class="col-lg-5 side-bar-item">NOM(en)</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $category->en_name }}</div>
                    <div class="col-lg-5 side-bar-item">Description(fr)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $category->fr_description }}
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Description(en)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $category->en_description }}
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Produits ({{ $category->products->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
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

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush