@extends('admin.layouts.admin')

@section('home.title', page_title($user->format_first_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($user->format_full_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.users.index'),
                            'label' => 'Liste des utilisateurs'
                            ])
                        @endcomponent
                        @component('components.modal-button', [
                           'target' => 'reset-password',
                           'title' => 'Réinitialiser le mot de passe de cet utilisateur', 'icon' => 'repeat',
                           'label' => 'Réinitialiser le mot de passe', 'class' => 'btn btn-warning'
                           ])
                        @endcomponent
                        @if(!$user->is_super_admin || ($user->is_super_admin && \Illuminate\Support\Facades\Auth::user()->is_super_admin))
                            @if($user->is_confirmed)
                                @component('components.modal-button', [
                                   'target' => 'disable-user',
                                   'title' => 'Désactiver cet utilisateur', 'icon' => 'thumbs-down',
                                   'label' => 'Désactiver', 'class' => 'btn btn-danger'
                                   ])
                                @endcomponent
                            @else
                                @component('components.modal-button', [
                                   'target' => 'enable-user',
                                   'title' => 'Activer cet utilisateur', 'icon' => 'thumbs-up',
                                   'label' => 'Activer', 'class' => 'btn btn-success'
                                   ])
                                @endcomponent
                            @endif
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->is_super_admin)
                            @if($user->is_super_admin)
                                @component('components.modal-button', [
                                   'target' => 'down-to-admin',
                                   'title' => 'Rétrograder le rôle de cet utilisateur', 'icon' => 'arrow-down',
                                   'label' => 'Rétrograder', 'class' => 'btn btn-primary'
                                   ])
                                @endcomponent
                            @else
                                @component('components.modal-button', [
                                   'target' => 'up-to-super-admin',
                                   'title' => 'Augmenter le rôle de cet utilisateur', 'icon' => 'arrow-up',
                                   'label' => 'Augmenter', 'class' => 'btn btn-info'
                                   ])
                                @endcomponent
                            @endif
                        @endif
                        @if(!$user->is_super_admin || ($user->is_super_admin && \Illuminate\Support\Facades\Auth::user()->is_super_admin))
                            @component('admin.components.delete-button', [
                                'target' => 'delete-user',
                                'title' => 'Supprimer cet utilisateur'
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
                    <div class="col-sm-5 side-bar-item">Email</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->email }}</div>
                    <div class="col-sm-5 side-bar-item">NOM</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->format_first_name }}</div>
                    <div class="col-sm-5 side-bar-item">Prénom</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->format_last_name }}</div>
                    <div class="col-sm-5 side-bar-item">Tel</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->phone }}</div>
                    <div class="col-sm-5 side-bar-item">Adresse</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->address }}</div>
                    <div class="col-sm-5 side-bar-item">Code potal</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->post_code }}</div>
                    <div class="col-sm-5 side-bar-item">Ville</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->city }}</div>
                    <div class="col-sm-5 side-bar-item">Pays</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->country }}</div>
                    <div class="col-sm-5 side-bar-item">Compagnie</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->company }}</div>
                    <div class="col-sm-5 side-bar-item">Statut</div>
                    <div class="col-sm-7 text-dark side-bar-item">
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
                    </div>
                    <div class="col-sm-5 side-bar-item">Rôle</div>
                    <div class="col-sm-7 text-dark side-bar-item">
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
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->created_date }} à {{ $user->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $user->updated_date }} à {{ $user->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @if(\Illuminate\Support\Facades\Auth::user()->is_super_admin)
        @component('components.modal', [
           'title' => 'Réinitialiser le mot de passe de l\'utilisateur', 'method' => 'POST',
           'id' => 'reset-password', 'color' => 'warning',
           'action_route' => route('admin.users.reset.password', [$user])
           ])
            Etes-vous sûr de vouloir réinitialiser le mot de passe de {{ text_format($user->format_full_name, 50) }}?
        @endcomponent
        @if($user->is_super_admin)
            @component('components.modal', [
                'title' => 'Rétrograder l\'utilisateur', 'method' => 'POST',
                'id' => 'down-to-admin', 'color' => 'primary',
                'action_route' => route('admin.users.down', [$user])
                ])
                Etes-vous sûr de vouloir rétrograder {{ text_format($user->format_full_name, 50) }}?
            @endcomponent
        @else
            @component('components.modal', [
                'title' => 'Augmenter l\'utilisateur', 'method' => 'PUT',
                'id' => 'up-to-super-admin', 'color' => 'info',
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
                'id' => 'disable-user', 'color' => 'danger',
                'action_route' => route('admin.users.disable', [$user])
                ])
                Etes-vous sûr de vouloir désactiver {{ text_format($user->format_full_name, 50) }}?
            @endcomponent
        @else
            @component('components.modal', [
                'title' => 'Activer l\'utilisateur', 'method' => 'PUT',
                'id' => 'enable-user', 'color' => 'success',
                'action_route' => route('admin.users.enable', [$user])
                ])
                Etes-vous sûr de vouloir activer {{ text_format($user->format_full_name, 50) }}?
            @endcomponent
        @endif
        @component('components.modal', [
            'title' => 'Supprimer l\'utilisateur',
            'id' => 'delete-user', 'color' => 'danger',
            'action_route' => route('admin.users.destroy', [$user])
            ])
            Etes-vous sûr de vouloir supprimer {{ text_format($user->format_full_name, 50) }}?
        @endcomponent
    @endif
@endsection