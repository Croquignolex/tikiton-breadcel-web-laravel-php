@extends('master')

@section('title', 'Connexion')

@section('body')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
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

@push('style.plugin')
    <link rel="stylesheet" href="{{ css_admin_asset('vendor.bundle.base') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_admin_asset('vendor.bundle.addons') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_admin_asset('admin') }}" type="text/css">
    @endpush

@push('style.page')
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
@endpush

@push('script.plugin')
    <script src="{{ js_admin_asset('vendor.bundle.base') }}" type="text/javascript"></script>
    <script src="{{ js_admin_asset('vendor.bundle.addons') }}" type="text/javascript"></script>
    <script src="{{ js_admin_asset('off-canvas') }}" type="text/javascript"></script>
    <script src="{{ js_admin_asset('misc') }}" type="text/javascript"></script>
@endpush

@push('script.page')
    <!-- Page scripts -->
    <script src="{{ js_admin_asset('admin') }}" type="text/javascript"></script>
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush