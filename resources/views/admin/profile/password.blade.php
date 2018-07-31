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
                        @component('admin.components.back-button', [
                            'route' => route('admin.profile.index'),
                            'label' => 'Mon profil'
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
                    <form class="forms-sample" method="POST" action=""
                          @submit="validateFormElements">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3">
                                <div class="form-group">
                                    @component('components.label-input', [
                                      'name' => 'old_password', 'label' => 'old_password'
                                      ])
                                        @component('components.input', [
                                            'type' => 'password', 'name' => 'old_password',
                                             'value' => old('old_password'), 'minlength' => 6,
                                             'class' => 'form-control',
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'password', 'label' => 'new_password'
                                        ])
                                        @component('components.input', [
                                            'type' => 'password', 'name' => 'password',
                                             'value' => old('password'), 'minlength' => 6,
                                             'class' => 'form-control',
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
                                             'class' => 'form-control',
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Modifier',
                                       'title' => 'Mettre à jour mon mot de passe'
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