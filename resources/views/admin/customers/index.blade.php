@extends('admin.layouts.admin')

@section('home.title', page_title('Clients'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('cubes') }}"></i>
                        CLIENTS
                        @component('admin.components.add-button',
                           ['route' => route('admin.customers.create')])
                        @endcomponent
                    </h4>
                    <p class="card-description">
                        Filtrer les clients
                    </p>
                    <div>
                        @component('admin.components.filter-button', [
                            'route' => route('admin.customers.index') . '?type=' . \App\Models\User::CUSTOMER_HAS_ORDER,
                            'icon' => 'file-text', 'label' => 'Clients qui ont déjà commandé'
                            ])
                        @endcomponent
                        @component('admin.components.filter-button', [
                            'route' => route('admin.customers.index') . '?type=' . \App\Models\User::CUSTOMER_HAS_NOT_ORDER,
                            'icon' => 'file', 'label' => 'Clients qui n\'ont pas encore commandé', 'class' => 'btn btn-info'
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
                'headers' => ['email', 'prénom', 'nom', 'téléphone', 'adresse', 'statut', 'commandes']
                ])
                @forelse($paginationTools->displayItems as $user)
                    <tr class="{{ !$user->is_confirmed ? 'text-danger' : '' }}">
                        <td>{{ text_format($user->email, 15) }}</td>
                        <td>{{ text_format($user->format_first_name, 15) }}</td>
                        <td>{{ text_format($user->format_last_name, 15) }}</td>
                        <td>{{ text_format($user->phone, 15) }}</td>
                        <td>{{ text_format($user->address, 20) }}</td>
                        <td class="text-center">
                            @if($user->is_confirmed)
                                <label class="badge badge-success">
                                    <i class="{{ font('thumbs-up') }}"></i>
                                    Confirmé
                                </label>
                            @else
                                <label class="badge badge-danger">
                                    <i class="{{ font('thumbs-down') }}"></i>
                                    Non confirmé
                                </label>
                            @endif
                        </td>
                        <td class="text-right">{{ $user->orders->count() }}</td>
                        <td class="text-right">
                            @if($user->is_confirmed)
                                @component('components.modal-button', [
                                   'target' => 'disable-customer-' . $user->id,
                                   'title' => 'Désactiver ce client', 'icon' => 'thumbs-down',
                                   'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                   ])
                                @endcomponent
                            @else
                                @component('components.modal-button', [
                                   'target' => 'enable-customer-' . $user->id,
                                   'title' => 'Activer ce client', 'icon' => 'thumbs-up',
                                   'label' => '', 'class' => 'btn btn-success btn-icons btn-rounded'
                                   ])
                                @endcomponent
                            @endif
                            @component('admin.components.details-button',
                               ['route' => route('admin.customers.show', [$user])])
                            @endcomponent
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

    @foreach($paginationTools->displayItems as $user)
        @if($user->is_confirmed)
            @component('components.modal', [
               'title' => 'Desactive le client', 'method' => 'POST',
               'id' => 'disable-customer-' . $user->id, 'color' => 'danger',
               'action_route' => route('admin.customers.disable', [$user])
               ])
                Etes-vous sûr de vouloir désactiver {{ text_format($user->format_full_name, 50) }}?
            @endcomponent
        @else
            @component('components.modal', [
                'title' => 'Activer le client', 'method' => 'PUT',
                'id' => 'enable-customer-' . $user->id, 'color' => 'success',
                'action_route' => route('admin.customers.enable', [$user])
                ])
                Etes-vous sûr de vouloir activer {{ text_format($user->format_full_name, 50) }}?
            @endcomponent
        @endif
    @endforeach
@endsection
