@extends('admin.layouts.admin')

@section('home.title', page_title($setting->label))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($setting->label) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.settings.index'),
                            'label' => 'Liste des paramètres'
                            ])
                        @endcomponent
                        @if(!$setting->is_activated)
                            @component('components.modal-button', [
                               'target' => 'apply-setting',
                               'title' => 'Activer ce paramètre', 'icon' => 'play',
                               'label' => 'Activer', 'class' => 'btn btn-success'
                               ])
                            @endcomponent
                        @endif
                        @component('admin.components.update-button', [
                            'route' => route('admin.settings.edit', [$setting]),
                            'title' => 'Modifier ce paramètre'
                            ])
                        @endcomponent
                        @if(!$setting->is_activated)
                            @component('admin.components.delete-button', [
                                'target' => 'delete-setting',
                                'title' => 'Supprimer ce paramètre'
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
                    <div class="col-sm-5 side-bar-item">LIBELLE</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->label }}</div>
                    <div class="col-sm-5 side-bar-item">TVA</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ money_currency($setting->format_tva) }}</div>
                    <div class="col-sm-5 side-bar-item">SLOGAN</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->slogan }}</div>
                    <div class="col-sm-5 side-bar-item">TELEPHONE 1</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->phone_1 }}</div>
                    <div class="col-sm-5 side-bar-item">TELEPHONE 2</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->phone_2 }}</div>
                    <div class="col-sm-5 side-bar-item">ADRESSE 1</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->address_1 }}</div>
                    <div class="col-sm-5 side-bar-item">ADRESSE 2</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->address_2 }}</div>
                    <div class="col-sm-5 side-bar-item">FACEBOOK</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <a href="{{ $setting->facebook }}" target="_blank">{{ $setting->facebook }}</a>
                    </div>
                    <div class="col-sm-5 side-bar-item">TWITTER</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <a href="{{ $setting->twitter }}" target="_blank">{{ $setting->twitter }}</a>
                    </div>
                    <div class="col-sm-5 side-bar-item">LINKED IN</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <a href="{{ $setting->linkedin }}" target="_blank">{{ $setting->linkedin }}</a>
                     </div>
                    <div class="col-sm-5 side-bar-item">GOOGLE PLUS</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <a href="{{ $setting->googleplus }}" target="_blank">{{ $setting->googleplus }}</a>
                    </div>
                    <div class="col-sm-5 side-bar-item">YOUTUBE</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <a href="{{ $setting->youtube }}" target="_blank">{{ $setting->youtube }}</a>
                    </div>
                    <div class="col-sm-5 side-bar-item">STATUT</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        @if($setting->is_activated)
                            <label class="badge badge-success">
                                <i class="{{ font('play') }}"></i>
                                Activé
                            </label>
                        @else
                            <label class="badge badge-danger">
                                <i class="{{ font('stop') }}"></i>
                                Désactivé
                            </label>
                        @endif
                    </div>
                    <div class="col-sm-5 side-bar-item">OPTIONS</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        @if($setting->receive_email_from_contact)
                            <label class="badge badge-theme"
                                   title="Recevoir un email lorsqu'un client envoie un méssage depuis le formulaire de contact">
                                <i class="{{ font('envelope') }}"></i>
                                <i class="{{ font('info') }}"></i>
                                Email nouveau message
                            </label>
                        @endif
                        @if($setting->receive_email_from_register)
                            <label class="badge badge-info"
                                   title="Recevoir un email lorsqu'un nouveau client confirme son compte">
                                <i class="{{ font('user') }}"></i>
                                <i class="{{ font('check') }}"></i>
                                Email nouveau client
                            </label>
                        @endif
                        @if($setting->receive_email_from_new_order)
                            <label class="badge badge-success"
                                   title="Recevoir un email lorsqu'un client emet une nouvelle commande">
                                <i class="{{ font('copy') }}"></i>
                                <i class="{{ font('check') }}"></i>
                                Email nouvelle commande
                            </label>
                        @endif
                        @if($setting->receive_email_from_canceled_order)
                            <label class="badge badge-danger"
                                   title="Recevoir un email lorsqu'un client annule une commande">
                                <i class="{{ font('copy') }}"></i>
                                <i class="{{ font('times') }}"></i>
                                Email commande annulé
                            </label>
                        @endif
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->created_date }} à {{ $setting->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $setting->updated_date }} à {{ $setting->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @if(!$setting->is_activated)
        @component('components.modal', [
            'title' => 'Supprimer le paramètre',
            'id' => 'delete-setting', 'color' => 'danger',
            'action_route' => route('admin.settings.destroy', [$setting])
            ])
            Etes-vous sûr de vouloir supprimer le paramètre {{ text_format($setting->label, 50) }}?
        @endcomponent
        @component('components.modal', [
                'title' => 'Utiliser le paramètre', 'method' => 'POST',
                'id' => 'apply-setting', 'color' => 'success',
                'action_route' => route('admin.settings.apply', [$setting])
                ])
            Etes-vous sûr de vouloir utiliser le paramètre {{ text_format($setting->label, 50) }}?
        @endcomponent
    @endif
@endsection