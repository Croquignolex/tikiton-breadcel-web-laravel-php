@extends('admin.layouts.admin')

@section('home.title', page_title($tag->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($tag->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.tags.index'),
                            'label' => 'Liste des étiquettes'
                            ])
                        @endcomponent
                        @component('admin.components.update-button', [
                            'route' => route('admin.tags.edit', [$tag]),
                            'title' => 'Modifier cette étiquette'
                            ])
                        @endcomponent
                        @if($tag->products->isEmpty())
                            @component('admin.components.delete-button', [
                                'target' => 'delete-tag',
                                'title' => 'Supprimer cette étiquette'
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
                    <div class="col-sm-7 text-dark side-bar-item">{{ $tag->fr_name }}</div>
                    <div class="col-sm-5 side-bar-item">NOM(en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $tag->en_name }}</div>
                    <div class="col-sm-5 side-bar-item">Description(fr)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $tag->fr_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Description(en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $tag->en_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Produits ({{ $tag->products->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p>
                            @forelse($tag->products as $product)
                                <a href="{{ route('admin.products.show', [$product]) }}" title="Est rattaché à cette étiquette">
                                    <label class="badge badge-theme">
                                        <i class="{{ font('database') }}"></i>
                                        {{ $product->format_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Cette étiquette n'est ratachée à aucun produit
                                </strong>
                            @endforelse
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $tag->created_date }} à {{ $tag->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $tag->updated_date }} à {{ $tag->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @if($tag->products->isEmpty())
        @component('components.modal', [
            'title' => 'Supprimer l\'étiquette',
            'id' => 'delete-tag', 'color' => 'danger',
            'action_route' => route('admin.tags.destroy', [$tag])
            ])
            Etes-vous sûr de vouloir supprimer {{ text_format($tag->format_name, 50) }}?
        @endcomponent
    @endif
@endsection