@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.contact')))
@section('overlay_text', trans('general.contact'))
@section('overlay_font', font('map-marker'))

@section('app.home.body')
    <!--Start Contact Area-->
    <div class="contact-page-2 page fix">
        <div class="container">
            <div class="row">
                @if(session()->has('notification.message'))
                    <div class="text-center col-sm-10 custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                        {{ session('notification.message') }}
                    </div>
                @endif
                <div class="contact-form col-sm-12">
                    <h2>@lang('general.leave_message')</h2>
                    <form action="" method="POST" @submit="validateFormElements">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                @component('components.label-input', [
                                    'name' => 'name', 'label' => 'name'
                                    ])
                                    @component('components.input', [
                                        'type' => 'text', 'name' => 'name',
                                         'value' => old('name'), 'auto_focus' => 'autofocus'
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
                                    'name' => 'phone', 'label' => 'phone'
                                    ])
                                    @component('components.input', [
                                        'type' => 'text', 'name' => 'phone',
                                        'value' => old('phone')
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.label-input', [
                                    'name' => 'subject', 'label' => 'subject'
                                    ])
                                    @component('components.input', [
                                        'type' => 'text','name' => 'subject',
                                        'value' => old('subject')
                                        ])
                                    @endcomponent
                                @endcomponent
                            </div>
                            <div class="col-sm-6">
                                @component('components.label-input', [
                                    'name' => 'message', 'label' => 'message'
                                    ])
                                    @component('components.textarea', [
                                        'name' => 'message', 'value' => old('message')
                                        ])
                                    @endcomponent
                                @endcomponent
                                @component('components.submit', [
                                    'class' => 'submit', 'value' => trans('general.send'),
                                    'title' => trans('general.send_your_message')
                                    ])
                                @endcomponent
                            </div>
                        </div>
                    </form>
                </div>
                <div class="contact-info col-sm-12">
                    <div class="row">
                        @component('components.contact-info', [
                            'font' => 'map-marker',
                            'info_1' => config('company.address_1'),
                            'info_2' => config('company.address_2')
                            ])
                        @endcomponent
                        @component('components.contact-info', [
                            'font' => 'phone',
                            'info_1' => config('company.phone_1'),
                            'info_2' => config('company.phone_2')
                            ])
                        @endcomponent
                        @component('components.contact-info', [
                            'font' => 'envelope',
                            'info_1' => config('company.email_1'),
                            'info_2' => config('company.email_2')
                            ])
                        @endcomponent
                    </div>
                </div>
                <div class="map-container col-sm-12">
                    <div id="googleMap"></div>
                </div>
            </div>
        </div>
    </div>
    <!--End Contact Area-->
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
@endpush