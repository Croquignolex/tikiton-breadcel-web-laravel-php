@extends('admin.layouts.admin')

@section('home.title', page_title('Paramètres'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('cogs') }}"></i>
                        PARAMETRES
                        @component('admin.components.add-button',
                           ['route' => route('admin.settings.create')])
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
                'headers' => ['libellé', 'slogan', 'tva', 'statut', 'options']
                ])
                @forelse($paginationTools->displayItems as $setting)
                    <tr class="{{ $setting->is_activated ? 'text-success' : '' }}">
                        <td>{{ text_format($setting->label, 20) }}</td>
                        <td>{{ text_format($setting->slogan, 20) }}</td>
                        <td class="text-right">{{ money_currency($setting->format_tva) }}</td>
                        <td class="text-center">
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
                        </td>
                        <td class="text-center">
                            @if($setting->receive_email_from_contact)
                                <label class="badge badge-theme"
                                       title="Recevoir un email lorsqu'un client envoie un méssage depuis le formulaire de contact">
                                    <i class="{{ font('envelope') }}"></i>
                                    <i class="{{ font('info') }}"></i>
                                </label>
                            @endif
                            @if($setting->receive_email_from_register)
                                <label class="badge badge-info"
                                       title="Recevoir un email lorsqu'un nouveau client confirme son compte">
                                    <i class="{{ font('user') }}"></i>
                                    <i class="{{ font('check') }}"></i>
                                </label>
                            @endif
                            @if($setting->receive_email_from_new_order)
                                <label class="badge badge-success"
                                       title="Recevoir un email lorsqu'un client emet une nouvelle commande">
                                    <i class="{{ font('copy') }}"></i>
                                    <i class="{{ font('check') }}"></i>
                                </label>
                            @endif
                            @if($setting->receive_email_from_canceled_order)
                                <label class="badge badge-danger"
                                       title="Recevoir un email lorsqu'un client annule une commande">
                                    <i class="{{ font('copy') }}"></i>
                                    <i class="{{ font('times') }}"></i>
                                </label>
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!$setting->is_activated)
                                @component('components.modal-button', [
                                   'target' => 'apply-setting-' . $setting->id,
                                   'title' => 'Utiliser ce paramètre', 'icon' => 'play',
                                   'label' => '', 'class' => 'btn btn-success btn-icons btn-rounded'
                                   ])
                                @endcomponent
                            @endif
                            @component('admin.components.update-button', [
                                'route' => route('admin.settings.edit', [$setting]),
                                'title' => 'Modifier ce paramètre',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                               ['route' => route('admin.settings.show', [$setting])])
                            @endcomponent
                            @if(!$setting->is_activated)
                                @component('admin.components.delete-button', [
                                   'target' => 'delete-setting-' . $setting->id,
                                   'title' => 'Supprimer ce paramètre',
                                   'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                   ])
                                @endcomponent
                            @endif
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 5, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $setting)
        @if(!$setting->is_activated)
            @component('components.modal', [
                'title' => 'Supprimer le paramètre',
                'id' => 'delete-setting-' . $setting->id, 'color' => 'danger',
                'action_route' => route('admin.settings.destroy', [$setting])
                ])
                Etes-vous sûr de vouloir supprimer le paramètre {{ text_format($setting->label, 50) }}?
            @endcomponent
            @component('components.modal', [
                'title' => 'Utiliser le paramètre', 'method' => 'POST',
                'id' => 'apply-setting-' . $setting->id, 'color' => 'success',
                'action_route' => route('admin.settings.apply', [$setting])
                ])
                Etes-vous sûr de vouloir utiliser le paramètre {{ text_format($setting->label, 50) }}?
            @endcomponent
        @endif
    @endforeach
@endsection
