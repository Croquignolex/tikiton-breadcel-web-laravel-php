@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.login')))
@section('overlay_text', trans('general.login'))
@section('overlay_font', font('unlock'))

@section('app.home.body')
    <!--start login Area-->
    <div class="login-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5 col-sm-offset-3">
                    <div class="login">
                        <h2>@lang('auth.enter_credentials')</h2>
                        @if(session()->has('notification.message'))
                            <div class="text-center col-sm-10 custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                                {{ session('notification.message') }}
                            </div>
                        @endif
                        <form id="signup-form" action="" method="POST" class="form-validation" @submit="validateElement">
                            {{ csrf_field() }}
                            @component('components.app.label-input', [
                                    'name' => 'email', 'label' => 'email',
                                    ])
                                @component('components.app.input', [
                                    'type' => 'email', 'name' => 'email',
                                     'value' => old('email'), 'auto_focus' => 'autofocus'
                                    ])
                                @endcomponent
                            @endcomponent
                            @component('components.app.label-input', [
                                    'name' => 'password', 'label' => 'password'
                                    ])
                                @component('components.app.input', [
                                    'type' => 'password', 'name' => 'password',
                                     'value' => old('password'), 'minlength' => 6
                                    ])
                                @endcomponent
                            @endcomponent
                            <div class="remember">
                                <a href="{{ locale_route('register.show') }}">@lang('auth.register_sign_upped')</a><br>
                                <a href="{{ locale_route('forgot.password.show') }}">@lang('auth.forgotten_pwd') ?</a>
                            </div>
                            @component('components.app.submit', [
                               'class' => 'submit', 'value' => trans('auth.login')
                               ])
                            @endcomponent
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End login Area-->
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('validator') }}" type="text/javascript"></script>
@endpush