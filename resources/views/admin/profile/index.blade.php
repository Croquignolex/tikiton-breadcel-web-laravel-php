@extends('admin.layouts.admin')

@section('home.title', page_title($user->format_first_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <strong class="text-theme">
                            {{ mb_strtoupper($user->format_full_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.update-button', [
                           'route' => route('admin.profile.edit'),
                           'title' => 'Modifier votre profil'
                           ])
                        @endcomponent
                            @component('admin.components.update-button', [
                               'route' => route('admin.profile.email'),
                               'title' => 'Modifier votre email',
                               'label' => 'Modifier votre email',
                               'class' => 'btn btn-secondary'
                               ])
                            @endcomponent
                        @component('admin.components.update-button', [
                           'route' => route('admin.profile.password'),
                           'title' => 'Modifier votre mot de passe',
                           'label' => 'Modifier votre mot de passe',
                           'class' => 'btn btn-dark'
                           ])
                        @endcomponent
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
@endsection