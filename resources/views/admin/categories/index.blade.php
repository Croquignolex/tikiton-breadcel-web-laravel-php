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
                        <a href="{{ route('admin.categories.create') }}"
                           class="btn btn-secondary">
                            <i class="{{ font('plus') }}"></i>
                            Ajouter
                        </a>
                    </h4>
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
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paginationTools->displayItems as $category)
                                    <tr>
                                        <td>{{ text_format($category->fr_name, 20) }}</td>
                                        <td>{{ text_format($category->en_name, 20) }}</td>
                                        <td>{{ text_format($category->fr_description, 30) }}</td>
                                        <td>{{ text_format($category->en_description, 30) }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-warning btn-icons btn-rounded" title="Modifier la catégorie"
                                                href="{{ route('admin.categories.edit', [$category]) }}">
                                                <i class="{{ font('pencil') }}"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-icons btn-rounded" title="Voir les détails"
                                               href="{{ route('admin.categories.show', [$category]) }}">
                                                <i class="{{ font('eye') }}"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-icons btn-rounded" title="Supprimer cette catégorie"
                                                data-toggle="modal" data-target="#delete-category-{{ $category->id }}">
                                                <i class="{{ font('trash-o') }}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
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

    @foreach($paginationTools->displayItems as $category)
        @component('components.modal', [
            'title' => 'Supprimer la categories',
            'id' => 'delete-category-' . $category->id, 'color' => 'danger',
            'action_route' => route('admin.categories.destroy', [$category])
            ])
            Etes-vous sûr de vouloir supprimer {{ $category->format_name }}?
        @endcomponent
    @endforeach
@endsection
