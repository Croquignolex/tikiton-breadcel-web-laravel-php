@extends('admin.layouts.admin')

@section('home.title', page_title('Clients'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('users') }}"></i>
                        CLIENTS
                        <a href="{{ route('admin.customers.create') }}"
                           class="btn btn-secondary">
                            <i class="{{ font('plus') }}"></i>
                            Ajouter
                        </a>
                    </h4>
                    <p class="card-description">
                        Filtrer les clients
                    </p>
                    <div>
                        <a href="{{ route('admin.customers.index') . '?type=' . \App\Models\User::CUSTOMER_HAS_ORDER }}"
                           class="btn btn-theme">
                            <i class="{{ font('file-text') }}"></i>
                            Clients qui ont déjà commandé
                        </a>
                        <a href="{{ route('admin.customers.index') . '?type=' . \App\Models\User::CUSTOMER_HAS_NOT_ORDER }}"
                           class="btn btn-info">
                            <i class="{{ font('file') }}"></i>
                            Clients qui n'ont pas encore commandé
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
                                    <th>EMAIL</th>
                                    <th>PRENOM</th>
                                    <th>NOM</th>
                                    <th>TELEPHONE</th>
                                    <th>ADRESSE</th>
                                    <th>STATUT</th>
                                    <th>COMMANDES</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paginationTools->displayItems as $user)
                                    <tr class="{{ !$user->is_confirmed ? 'text-danger' : '' }}">
                                        <td>{{ text_format($user->email, 15) }}</td>
                                        <td>{{ text_format($user->format_first_name, 15) }}</td>
                                        <td>{{ text_format($user->format_last_name, 15) }}</td>
                                        <td>{{ text_format($user->phone, 15) }}</td>
                                        <td>{{ text_format($user->address, 20) }}</td>
                                        <td class="text-center">
                                            @if($user->is_confirmed)
                                                <label class="badge badge-success" title="">
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
                                            <a class="btn btn-secondary btn-icons btn-rounded" title="Voir les détails"
                                               href="{{ route('admin.customers.show', [$user]) }}">
                                                <i class="{{ font('eye') }}"></i>
                                            </a>
                                            @if($user->is_confirmed)
                                                <button type="button" class="btn btn-danger btn-icons btn-rounded" title="Désactiver ce client"
                                                        data-toggle="modal" data-target="#disable-customer-{{ $user->id }}">
                                                    <i class="{{ font('thumbs-down') }}"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-success btn-icons btn-rounded" title="Activer ce client"
                                                        data-toggle="modal" data-target="#enable-customer-{{ $user->id }}">
                                                    <i class="{{ font('thumbs-up') }}"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
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
