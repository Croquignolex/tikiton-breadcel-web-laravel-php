@extends('admin.layouts.admin')

@section('home.title', page_title('Utilisateurs'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('users') }}"></i>
                        UTILISATEURS
                        @component('admin.components.add-button',
                           ['route' => route('admin.users.create')])
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
                'headers' => ['email', 'prénom', 'nom', 'téléphone', 'statut', 'rôle']
                ])
                @forelse($paginationTools->displayItems as $user)
                    <tr class="{{ !$user->is_confirmed ? 'text-danger' : '' }}">
                        <td>{{ text_format($user->email, 10) }}</td>
                        <td>{{ text_format($user->format_first_name, 10) }}</td>
                        <td>{{ text_format($user->format_last_name, 10) }}</td>
                        <td>{{ text_format($user->phone, 10) }}</td>
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
                        <td class="text-center">
                            @if($user->is_super_admin)
                                <label class="badge badge-info">
                                    <i class="{{ font('star') }}"></i>
                                    <i class="{{ font('star') }}"></i>
                                    Super administrateur
                                </label>
                            @elseif($user->is_admin)
                                <label class="badge badge-primary">
                                    <i class="{{ font('star') }}"></i>
                                    Administrateur
                                </label>
                            @endif
                        </td>
                        <td class="text-right">
                            @component('components.modal-button', [
                               'target' => 'reset-password-' . $user->id,
                               'title' => 'Réinitialiser le mot de passe de cet utilisateur', 'icon' => 'repeat',
                               'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                               ])
                            @endcomponent
                            @if(\Illuminate\Support\Facades\Auth::user()->is_super_admin)
                                @if($user->is_super_admin)
                                    @component('components.modal-button', [
                                       'target' => 'down-to-admin-' . $user->id,
                                       'title' => 'Rétrograder le rôle de cet utilisateur', 'icon' => 'arrow-down',
                                       'label' => '', 'class' => 'btn btn-primary btn-icons btn-rounded'
                                       ])
                                    @endcomponent
                                @else
                                    @component('components.modal-button', [
                                       'target' => 'up-to-super-admin-' . $user->id,
                                       'title' => 'Augmenter le rôle de cet utilisateur', 'icon' => 'arrow-up',
                                       'label' => '', 'class' => 'btn btn-info btn-icons btn-rounded'
                                       ])
                                    @endcomponent
                                @endif
                            @endif
                            @if(!$user->is_super_admin || ($user->is_super_admin && \Illuminate\Support\Facades\Auth::user()->is_super_admin))
                                @if($user->is_confirmed)
                                    @component('components.modal-button', [
                                       'target' => 'disable-user-' . $user->id,
                                       'title' => 'Désactiver cet utilisateur', 'icon' => 'thumbs-down',
                                       'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                       ])
                                    @endcomponent
                                @else
                                    @component('components.modal-button', [
                                       'target' => 'enable-user-' . $user->id,
                                       'title' => 'Activer cet utilisateur', 'icon' => 'thumbs-up',
                                       'label' => '', 'class' => 'btn btn-success btn-icons btn-rounded'
                                       ])
                                    @endcomponent
                                @endif
                            @endif
                            @component('admin.components.details-button',
                               ['route' => route('admin.users.show', [$user])])
                            @endcomponent
                            @if(!$user->is_super_admin || ($user->is_super_admin && \Illuminate\Support\Facades\Auth::user()->is_super_admin))
                                @component('admin.components.delete-button', [
                                    'target' => 'delete-user-' . $user->id,
                                    'title' => 'Supprimer cet utilisateur',
                                    'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                    ])
                                @endcomponent
                            @endif
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 7, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $user)
        @component('components.modal', [
           'title' => 'Réinitialiser le mot de passe de l\'utilisateur', 'method' => 'POST',
           'id' => 'reset-password-' . $user->id, 'color' => 'warning',
           'action_route' => route('admin.users.reset.password', [$user])
           ])
            Etes-vous sûr de vouloir réinitialiser le mot de passe de {{ text_format($user->format_full_name, 50) }}?
        @endcomponent
        @if(\Illuminate\Support\Facades\Auth::user()->is_super_admin)
            @if($user->is_super_admin)
                @component('components.modal', [
                    'title' => 'Rétrograder l\'utilisateur', 'method' => 'POST',
                    'id' => 'down-to-admin-' . $user->id, 'color' => 'primary',
                    'action_route' => route('admin.users.down', [$user])
                    ])
                    Etes-vous sûr de vouloir rétrograder {{ text_format($user->format_full_name, 50) }}?
                @endcomponent
            @else
                @component('components.modal', [
                    'title' => 'Augmenter l\'utilisateur', 'method' => 'PUT',
                    'id' => 'up-to-super-admin-' . $user->id, 'color' => 'info',
                    'action_route' => route('admin.users.up', [$user])
                    ])
                    Etes-vous sûr de vouloir augmenter {{ text_format($user->format_full_name, 50) }}?
                @endcomponent
            @endif
        @endif
        @if(!$user->is_super_admin || ($user->is_super_admin && \Illuminate\Support\Facades\Auth::user()->is_super_admin))
            @if($user->is_confirmed)
                @component('components.modal', [
                    'title' => 'Desactive l\'utilisateur', 'method' => 'POST',
                    'id' => 'disable-user-' . $user->id, 'color' => 'danger',
                    'action_route' => route('admin.users.disable', [$user])
                    ])
                    Etes-vous sûr de vouloir désactiver {{ text_format($user->format_full_name, 50) }}?
                @endcomponent
            @else
                @component('components.modal', [
                    'title' => 'Activer l\'utilisateur', 'method' => 'PUT',
                    'id' => 'enable-user-' . $user->id, 'color' => 'success',
                    'action_route' => route('admin.users.enable', [$user])
                    ])
                    Etes-vous sûr de vouloir activer {{ text_format($user->format_full_name, 50) }}?
                @endcomponent
            @endif
            @component('components.modal', [
                'title' => 'Supprimer l\'utilisateur',
                'id' => 'delete-user-' . $user->id, 'color' => 'danger',
                'action_route' => route('admin.users.destroy', [$user])
                ])
                Etes-vous sûr de vouloir supprimer {{ text_format($user->format_full_name, 50) }}?
            @endcomponent
        @endif
    @endforeach
@endsection
