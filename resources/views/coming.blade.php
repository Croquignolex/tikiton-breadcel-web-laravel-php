@extends('master')

@section('title', 'coming soon')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-7">
                <div class="come-logo">
                    <img src="{{ img_asset('logo') }}" alt="..." />
                </div>
                <div class="comming-soon-text text-center">
                    <h2>BIENVENUE SUR BREAD'CEL</h2>
                    <h2>DE CEL & CEL</h2>
                    <div class="come-soon">
                        <h4>WE ARE COMMING</h4>
                        <div class="come-border">
                            <div class="come-bottom float-left"></div>
                            <i class="{{ font('heart') }}float-left"></i>
                            <div class="come-bottom float-left"></div>
                        </div>
                        <h4>REALLY SOON</h4>
                    </div>
                    <div class="come-socials">
                        @component('components.icon-link', [
                        'icon' => 'facebook', 'link' => config('company.facebook'),
                        'title' => trans('general.goto_facebook')
                        ])
                        @endcomponent
                        @component('components.icon-link', [
                            'icon' => 'twitter', 'link' => config('company.twitter'),
                            'title' => trans('general.goto_twitter')
                            ])
                        @endcomponent
                        @component('components.icon-link', [
                            'icon' => 'linkedin', 'link' => config('company.linked_in'),
                            'title' => trans('general.goto_linked_in')
                             ])
                        @endcomponent
                        @component('components.icon-link', [
                            'icon' => 'google-plus', 'link' => config('company.google_plus'),
                            'title' =>  trans('general.goto_google_plus')
                            ])
                        @endcomponent
                        @component('components.icon-link', [
                            'icon' => 'youtube-play', 'link' => config('company.youtube'),
                            'title' => trans('general.goto_youtube')
                            ])
                        @endcomponent
                    </div>
                    @if(session()->has('notification.message'))
                        <div class="text-center col-sm-10 custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                            {{ session('notification.message') }}
                        </div>
                    @endif
                    <div class="login">
                        <form action="" method="POST">
                            {{ csrf_field() }}
                            @component('components.input', [
                               'type' => 'password', 'name' => 'code',
                               'value' => old('code')
                            ])
                            @endcomponent
                            @component('components.submit', [
                                'class' => 'submit', 'value' => 'Avoir un avant goût',
                                'title' => 'Voir l\'évolution de la platforme'
                                ])
                            @endcomponent
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-5">
                <div class="come-soon-img">
                    <img src="{{ img_asset('coming', 'jpg') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style.plugin')
    <link rel="stylesheet" href="{{ css_asset('owl.carousel.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('animate') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('jquery.simpleLens') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('jquery-price-slider') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('meanmenu.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('magnific-popup') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('nivo-slider') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('responsive') }}" type="text/css">
@endpush

@push('style.page')
    <link rel="stylesheet" href="{{ css_asset('app') }}" type="text/css">
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
@endpush
