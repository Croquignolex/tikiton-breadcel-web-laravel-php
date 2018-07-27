@extends('admin.layouts.admin')

@section('home.title', page_title('Equipe'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('user-secret') }}"></i>
                        EQUIPE
                        @component('admin.components.add-button',
                           ['route' => route('admin.teams.create')])
                        @endcomponent
                    </h4>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            @component('admin.components.table-card', [
                'table_label' => $table_label,
                'paginationTools' => $paginationTools,
                'headers' => ['nom', 'fonction (fr)', 'fonction (en)', 'description (fr)', 'description (en)']
                ])
                @forelse($paginationTools->displayItems as $team)
                    <tr>
                        <td>{{ text_format($team->format_name, 15) }}</td>
                        <td>{{ text_format($team->fr_function, 15) }}</td>
                        <td>{{ text_format($team->en_function, 15) }}</td>
                        <td>{{ text_format($team->fr_description, 20) }}</td>
                        <td>{{ text_format($team->en_description, 20) }}</td>
                        <td class="text-right">
                            @component('admin.components.update-button', [
                                'route' => route('admin.teams.edit', [$team]),
                                'title' => 'Modifier ce membre',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                               ['route' => route('admin.teams.show', [$team])])
                            @endcomponent
                            @component('admin.components.delete-button', [
                               'target' => 'delete-team-' . $team->id,
                               'title' => 'Supprimer ce membre',
                               'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                               ])
                            @endcomponent
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

    @foreach($paginationTools->displayItems as $team)
        @component('components.modal', [
            'title' => 'Supprimer le membre',
            'id' => 'delete-team-' . $team->id, 'color' => 'danger',
            'action_route' => route('admin.teams.destroy', [$team])
            ])
            Etes-vous sûr de vouloir supprimer le membre {{ text_format($team->format_name, 50) }}?
        @endcomponent
    @endforeach
@endsection
