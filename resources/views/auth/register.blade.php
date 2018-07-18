@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.register')))
@section('overlay_text', trans('general.register'))
@section('overlay_font', font('user-plus'))

@section('app.home.body')
    <!--start login Area-->
    <div class="login-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="login">
                        <h2>@lang('auth.new_account')</h2>
                        @if(session()->has('notification.message'))
                            <div class="text-center col-sm-10 custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                                {{ session('notification.message') }}
                            </div>
                        @endif
                        <form id="signup-form" action="" method="POST" @submit="validateFormElements">
                            {{ csrf_field() }}
                            @component('components.label-input', [
                                    'name' => 'first_name', 'label' => 'first_name'
                                    ])
                                @component('components.input', [
                                    'type' => 'text', 'name' => 'first_name',
                                     'value' => old('first_name'), 'auto_focus' => 'autofocus'
                                    ])
                                @endcomponent
                            @endcomponent
                            @component('components.label-input', [
                                    'name' => 'last_name', 'label' => 'last_name'
                                    ])
                                @component('components.input', [
                                    'type' => 'text', 'name' => 'last_name',
                                     'value' => old('last_name'), 'auto_focus' => 'autofocus'
                                    ])
                                @endcomponent
                            @endcomponent
                            @component('components.label-input', [
                                    'name' => 'email', 'label' => 'email',
                                    ])
                                @component('components.input', [
                                    'type' => 'email', 'name' => 'email',
                                     'value' => old('email')
                                    ])
                                @endcomponent
                            @endcomponent
                            @component('components.label-input', [
                                    'name' => 'password', 'label' => 'password'
                                    ])
                                @component('components.input', [
                                    'type' => 'password', 'name' => 'password',
                                     'value' => old('password'), 'minlength' => 6
                                    ])
                                @endcomponent
                            @endcomponent
                            @component('components.label-input', [
                                    'name' => 'password_confirmation', 'label' => 'pwd_cfm'
                                    ])
                                @component('components.input', [
                                    'type' => 'password', 'name' => 'password_confirmation',
                                     'value' => old('password_confirmation'), 'minlength' => 6
                                    ])
                                @endcomponent
                            @endcomponent
                            <div class="remember">
                                <a href="{{ locale_route('login') }}">@lang('auth.login_sign_upped')</a>
                            </div>
                            @component('components.submit', [
                               'class' => 'submit', 'value' => trans('auth.register')
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
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-3') }}" type="text/javascript"></script>
@endpush