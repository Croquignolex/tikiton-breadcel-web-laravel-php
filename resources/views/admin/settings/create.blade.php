@extends('admin.layouts.admin')

@section('home.title', page_title('Nouveau paramètre'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Nouveau paramètre
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.settings.index'),
                            'label' => 'Liste des paramètres'
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
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{ route('admin.settings.store') }}"
                          @submit="validateFormElements">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'label', 'label' => 'label'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'label', 'class' => 'form-control',
                                             'value' => old('label'), 'auto_focus' => 'autofocus'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'slogan', 'label' => 'slogan'
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'slogan', 'class' => 'form-control',
                                             'value' => old('slogan')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'tva', 'label' => 'tva'
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'tva', 'class' => 'form-control',
                                             'value' => old('tva') ?? 0, 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'address_1', 'label' => 'address_1'
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'address_1', 'class' => 'form-control',
                                             'value' => old('address_1')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'address_2', 'label' => 'address_2', 'no_star' => ''
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'address_2', 'class' => 'form-control',
                                             'value' => old('address_2'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'phone_1', 'label' => 'phone_1'
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'phone_1', 'class' => 'form-control',
                                             'value' => old('phone_1')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'phone_2', 'label' => 'phone_2', 'no_star' => ''
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'phone_2', 'class' => 'form-control',
                                             'value' => old('phone_2'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'facebook', 'label' => 'facebook', 'no_star' => ''
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'facebook', 'class' => 'form-control',
                                             'value' => old('facebook'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'twitter', 'label' => 'twitter', 'no_star' => ''
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'twitter', 'class' => 'form-control',
                                             'value' => old('twitter'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'linkedin', 'label' => 'linkedin', 'no_star' => ''
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'linkedin', 'class' => 'form-control',
                                             'value' => old('linkedin'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'googleplus', 'label' => 'googleplus', 'no_star' => ''
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'googleplus', 'class' => 'form-control',
                                             'value' => old('googleplus'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'youtube', 'label' => 'youtube', 'no_star' => ''
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'youtube', 'class' => 'form-control',
                                             'value' => old('youtube'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="email_new_message" id="email_new_message"
                                               title="Recevoir un email lorsqu'un client envoie un méssage depuis le formulaire de contact"
                                                {{ old('email_new_message') === 'on' ? 'checked' : '' }}>
                                        <label class="badge badge-theme"
                                               title="Recevoir un email lorsqu'un client envoie un méssage depuis le formulaire de contact">
                                            <i class="{{ font('envelope') }}"></i>
                                            <i class="{{ font('info') }}"></i>
                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" class="form-check-input" name="email_new_customer" id="email_new_customer"
                                               title="Recevoir un email lorsqu'un nouveau client confirme son compte"
                                                {{ old('email_new_customer') === 'on' ? 'checked' : '' }}>
                                        <label class="badge badge-info"
                                               title="Recevoir un email lorsqu'un nouveau client confirme son compte">
                                            <i class="{{ font('user') }}"></i>
                                            <i class="{{ font('check') }}"></i>
                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" class="form-check-input" name="email_new_order" id="email_new_order"
                                               title="Recevoir un email lorsqu'un client emet une nouvelle commande"
                                                {{ old('email_new_order') === 'on' ? 'checked' : '' }}>
                                        <label class="badge badge-success"
                                               title="Recevoir un email lorsqu'un client emet une nouvelle commande">
                                            <i class="{{ font('copy') }}"></i>
                                            <i class="{{ font('check') }}"></i>
                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" class="form-check-input" name="email_order_cancel" id="email_order_cancel"
                                               title="Recevoir un email lorsqu'un client annule une commande"
                                                {{ old('email_order_cancel') === 'on' ? 'checked' : '' }}>
                                        <label class="badge badge-danger"
                                               title="Recevoir un email lorsqu'un client annule une commande">
                                            <i class="{{ font('copy') }}"></i>
                                            <i class="{{ font('times') }}"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Ajouter',
                                       'title' => 'Créer ce membre'
                                       ])
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush