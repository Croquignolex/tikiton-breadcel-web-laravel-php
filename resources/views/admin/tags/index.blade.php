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
                        @component('admin.components.add-button',
                           ['route' => route('admin.tags.create')])
                        @endcomponent
                    </h4>
                    <p class="card-description">
                        Filtrer les étiquettes
                    </p>
                    <div>
                        @component('admin.components.filter-button', [
                            'route' => route('admin.tags.index') . '?type=' . \App\Models\Tag::HAS_PRODUCTS,
                            'icon' => 'link', 'label' => 'Qui sont rattachées à des produits'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                            'route' => route('admin.tags.index') . '?type=' . \App\Models\Tag::HAS_NO_PRODUCTS,
                            'icon' => 'unlink', 'label' => 'Qui ne sont pas rattachées à des produits', 'class' => 'btn btn-danger'
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
                @forelse($paginationTools->displayItems as $tag)
                    <tr class="{{ $tag->products->isEmpty() ? 'text-danger' : '' }}">
                        <td>{{ text_format($tag->fr_name, 15) }}</td>
                        <td>{{ text_format($tag->en_name, 15) }}</td>
                        <td>{{ text_format($tag->fr_description, 20) }}</td>
                        <td>{{ text_format($tag->en_description, 20) }}</td>
                        <td class="text-right">{{ $tag->products->count() }}</td>
                        <td class="text-right">
                            @component('admin.components.update-button', [
                                'route' => route('admin.tags.edit', [$tag]),
                                'title' => 'Modifier cette étiquette',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                                ['route' => route('admin.tags.show', [$tag])])
                            @endcomponent
                            @if($tag->products->isEmpty())
                                @component('admin.components.delete-button', [
                                    'target' => 'delete-tag-' . $tag->id,
                                    'title' => 'Supprimer cette étiquette',
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
