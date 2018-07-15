@extends('admin.layouts.admin')

@section('home.title', 'Connexion')

@section('home.body')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="text-center">
                            <a href="{{ locale_route('home') }}">
                                <img src="{{ img_asset('logo') }}" alt="..." />
                            </a>
                            <h3 class="mb-4">
                                Connexion
                            </h3>
                        </div>
                        @if(session()->has('notification.message'))
                            <div class="text-center custom-alert-{{ session('notification.type') }}">
                                {{ session('notification.message') }}
                            </div>
                        @endif
                        <div class="auto-form-wrapper">
                            <form action="" method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'email', 'label' => 'email'
                                        ])
                                        @component('components.input', [
                                            'type' => 'email', 'name' => 'email',
                                             'value' => old('email'), 'class' => 'form-control'
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
                                              'minlength' => 6, 'class' => 'form-control',
                                             'value' => old('password')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'submit-btn btn-bck btn btn-theme',
                                       'value' => 'Connexion',
                                       'title' => 'Cliquer pour se connecter'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="text-block text-center my-3">
                                    <a href="{{ route('admin.password.request') }}" class="text-black text-small">Mot de passe oublié ?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

@push('admin.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
@endpush