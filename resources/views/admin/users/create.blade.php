@extends('admin.layouts.admin')

@section('home.title', page_title('Nouvel utilisateur'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Nouvel utilisateur
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.users.index'),
                            'label' => 'Liste des utilisateurs'
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.users.store') }}"
                          @submit="validateFormElements">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'email', 'label' => 'email'
                                       ])
                                        @component('components.input', [
                                            'type' => 'email', 'name' => 'email', 'class' => 'form-control',
                                             'value' => old('email'), 'auto_focus' => 'autofocus'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'first_name', 'label' => 'first_name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'first_name', 'class' => 'form-control',
                                             'value' => old('first_name')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'last_name', 'label' => 'last_name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'last_name', 'class' => 'form-control',
                                             'value' => old('last_name')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                    'name' => 'password', 'label' => 'password'
                                    ])
                                        @component('components.input', [
                                            'type' => 'password', 'name' => 'password',
                                             'value' => old('password'), 'minlength' => 6,
                                             'class' => 'form-control'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'password_confirmation', 'label' => 'pwd_cfm'
                                        ])
                                        @component('components.input', [
                                            'type' => 'password', 'name' => 'password_confirmation',
                                             'value' => old('password_confirmation'), 'minlength' => 6,
                                             'class' => 'form-control'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'phone', 'label' => 'phone'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'phone', 'class' => 'form-control',
                                             'value' => old('phone'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'address', 'label' => 'address'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'address', 'class' => 'form-control',
                                             'value' => old('address'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'post_code', 'label' => 'post_code'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'post_code', 'class' => 'form-control',
                                             'value' => old('post_code'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'city', 'label' => 'city'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'city', 'class' => 'form-control',
                                             'value' => old('city'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'country', 'label' => 'country'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'country', 'class' => 'form-control',
                                             'value' => old('country'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'company', 'label' => 'company'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'company', 'class' => 'form-control',
                                             'value' => old('company'), 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Ajouter',
                                       'title' => 'Créer cet utilisateur'
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