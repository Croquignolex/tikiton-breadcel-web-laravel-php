@extends('layouts.overlay')

@section('app.home.title', page_title(trans('auth.change_email')))
@section('overlay_text', trans('auth.change_email'))
@section('overlay_font', font('at'))

@section('app.home.body')
    <!--start login Area-->
    <div class="login-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-5 col-sm-offset-3">
                    <div class="login">
                        @if(session()->has('notification.message'))
                            <div class="text-center col-sm-10 custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                                {{ session('notification.message') }}
                            </div>
                        @endif
                        <form id="signup-form" action="" method="POST" @submit="validateFormElements">
                            {{ csrf_field() }}
                            @component('components.label-input', [
                                    'name' => 'email', 'label' => 'new_email',
                                    ])
                                @component('components.input', [
                                    'type' => 'email', 'name' => 'email',
                                     'value' => old('email'), 'auto_focus' => 'autofocus'
                                    ])
                                @endcomponent
                            @endcomponent
                            @component('components.submit', [
                               'class' => 'submit', 'value' => trans('general.update')
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