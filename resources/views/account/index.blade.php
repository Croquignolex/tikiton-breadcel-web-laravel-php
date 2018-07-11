@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_account')))
@section('overlay_text', trans('general.my_account'))
@section('overlay_font', font('user'))

@section('app.home.body')
    <!--Start User Area-->
    <div class="contact-page page fix">
        <div class="container">
            <div class="row">
                @if(session()->has('notification.message'))
                    <div class="text-center col-sm-10 custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                        {{ session('notification.message') }}
                    </div>
                @endif
                <div class="contact-form col-sm-12">
                    <form action="" method="POST" @submit="validateFormElements">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12 text-center email_pwd_btn">
                                <a href="{{ locale_route('account.email') }}" class="btn btn-lg btn-danger">
                                    <i class="{{ font('at') }}"></i>
                                    @lang('auth.change_email')
                                </a>
                                <a href="{{ locale_route('account.password') }}" class="btn btn-lg btn-theme">
                                    <i class="{{ font('lock') }}"></i>
                                    @lang('auth.change_pwd')
                                </a>
                            </div>
                            <div class="col-sm-6">
                                @component('components.label-input', [
                                    'name' => 'first_name', 'label' => 'first_name'
                                    ])
                                    @component('components.input', [
                                        'auto_focus' => 'autofocus',
                                        'type' => 'text', 'name' => 'first_name',
                                         'value' => old('first_name') ?? $user->first_name
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                    'name' => 'last_name', 'label' => 'last_name',
                                    ])
                                    @component('components.input', [
                                        'type' => 'text', 'name' => 'last_name',
                                         'value' => old('last_name') ?? $user->last_name
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                    'name' => 'phone', 'label' => 'phone'
                                    ])
                                    @component('components.input', [
                                        'type' => 'text','name' => 'phone',
                                        'value' => old('phone') ?? $user->phone
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                    'name' => 'company', 'label' => 'company',
                                    'no_star' => ''
                                    ])
                                    @component('components.input', [
                                        'value' => old('company') ?? $user->company,
                                        'placeholder' => '(' . trans('general.optional') . ')',
                                        'type' => 'text','name' => 'company', 'validate' => 'false'
                                        ])
                                    @endcomponent
                                @endcomponent
                            </div>
                            <div class="col-sm-6">
                                @component('components.label-input', [
                                   'name' => 'country', 'label' => 'country'
                                   ])
                                    @component('components.input', [
                                        'type' => 'text', 'name' => 'country',
                                        'value' => old('country') ?? $user->country
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                    'name' => 'city', 'label' => 'city'
                                    ])
                                    @component('components.input', [
                                        'type' => 'text','name' => 'city',
                                        'value' => old('city') ?? $user->city
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                    'name' => 'address', 'label' => 'address'
                                    ])
                                    @component('components.input', [
                                        'type' => 'text','name' => 'address',
                                        'value' => old('address') ?? $user->address
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                'name' => 'post_code', 'label' => 'post_code'
                                ])
                                    @component('components.input', [
                                        'type' => 'text','name' => 'post_code',
                                        'value' => old('post_code') ?? $user->post_code
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.submit', [
                                    'class' => 'submit', 'value' => trans('general.update')
                                    ])
                                @endcomponent
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End User Area-->
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
@endpush