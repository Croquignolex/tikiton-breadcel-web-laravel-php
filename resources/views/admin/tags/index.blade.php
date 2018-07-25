@extends('admin.layouts.admin')

@section('home.title', page_title('Etiquettes'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('tags') }}"></i>
                        ETIQUETTES
                        <a href="{{ route('admin.tags.create') }}"
                           class="btn btn-secondary">
                            <i class="{{ font('plus') }}"></i>
                            Ajouter
                        </a>
                    </h4>
                    <p class="card-description">
                        Filtrer les étiquettes
                    </p>
                    <div>
                        <a href="{{ route('admin.tags.index') . '?type=' . \App\Models\Tag::HAS_PRODUCTS }}"
                           class="btn btn-theme">
                            <i class="{{ font('folder') }}"></i>
                            Qui sont rattachées à des produits
                        </a>
                        <a href="{{ route('admin.tags.index') . '?type=' . \App\Models\Tag::HAS_NO_PRODUCTS }}"
                           class="btn btn-danger">
                            <i class="{{ font('folder-open') }}"></i>
                            Qui ne sont pas rattachées à des produits
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
                                    <th>DESCRIPTION (fr)</th>
                                    <th>DESCRIPTION (en)</th>
                                    <th>PRODUITS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paginationTools->displayItems as $tag)
                                    <tr class="{{ $tag->products->isEmpty() ? 'text-danger' : '' }}">
                                        <td>{{ text_format($tag->fr_name, 15) }}</td>
                                        <td>{{ text_format($tag->en_name, 15) }}</td>
                                        <td>{{ text_format($tag->fr_description, 20) }}</td>
                                        <td>{{ text_format($tag->en_description, 20) }}</td>
                                        <td class="text-right">{{ $tag->products->count() }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-warning btn-icons btn-rounded" title="Modifier l'étiquette"
                                                href="{{ route('admin.tags.edit', [$tag]) }}">
                                                <i class="{{ font('pencil') }}"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-icons btn-rounded" title="Voir les détails"
                                               href="{{ route('admin.tags.show', [$tag]) }}">
                                                <i class="{{ font('eye') }}"></i>
                                            </a>
                                            @if($tag->products->isEmpty())
                                                <button type="button" class="btn btn-danger btn-icons btn-rounded" title="Supprimer cette étiquette"
                                                    data-toggle="modal" data-target="#delete-tag-{{ $tag->id }}">
                                                    <i class="{{ font('trash-o') }}"></i>
                                                </button>
                                            @endif
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

    @foreach($paginationTools->displayItems as $tag)
        @if($tag->products->isEmpty())
            @component('components.modal', [
                'title' => 'Supprimer l\'étiquette',
                'id' => 'delete-tag-' . $tag->id, 'color' => 'danger',
                'action_route' => route('admin.tags.destroy', [$tag])
                ])
                Etes-vous sûr de vouloir supprimer {{ text_format($tag->format_name, 50) }}?
            @endcomponent
        @endif
    @endforeach
@endsection
