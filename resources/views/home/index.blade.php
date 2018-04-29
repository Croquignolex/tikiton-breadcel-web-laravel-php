@extends('layouts.home.home')

@section('home.title', page_title(trans('home.home')))

@section('home.body')
    <!-- Navigation -->
    @component('components.home.navbar')
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#download">@lang('home.download')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#features">@lang('home.features')</a>
        </li>
        @include('partials.home.nav-item')
    @endcomponent

    @component('components.home.header', ['class' => 'masthead'])
        <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
                <h1 class="mb-5">@lang('home.landing_msg').</h1>
                <a href="{{ locale_route('login.show') }}" class="btn btn-outline btn-xl js-scroll-trigger border-radius-theme bounce-theme">
                    <i class="fa fa-thumbs-o-up"></i>
                    @lang('home.get_started')
                </a>
            </div>
        </div>
        <div class="col-lg-5 my-auto">
            <div class="device-container">
                <div class="device-mockup iphone6_plus portrait gold">
                    <div class="device">
                        <div class="screen">
                            <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                            <img src="{{ img_asset('home/demo-screen-1', 'jpg') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent

    @component('components.home.gradient', ['id' => 'download'])
        <h2>@lang('home.get_your_mobil_app')!</h2>
        <p>{{ config('app.name') }} @lang('home.download_mobil_app')!</p>
        <div class="badges">
            <a class="badge-link" href="#"><img src="{{ img_asset('home/google-play-badge', 'svg') }}" alt=""></a>
            <a class="badge-link" href="#"><img src="{{ img_asset('home/app-store-badge', 'svg') }}" alt=""></a>
        </div>
    @endcomponent

    @component('components.home.section', ['id' => 'features', 'class' => 'features'])
        <div class="section-heading text-center">
            <h2>@lang('home.awesome_features').</h2>
            <p class="text-muted">@lang('home.check_offer', ['app' => config('app.name')]).</p>
        </div>
        <div class="row">
            <div class="col-lg-4 my-auto">
                <div class="device-container">
                    <div class="device-mockup galaxy_s5 gold portrait">
                        <div class="device">
                            <div class="screen">
                                <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                                <img src="{{ img_asset('home/demo-screen-1', 'jpg') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 my-auto">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="feature-item">
                                <i class="fa fa-lock bg-gradient-theme"></i>
                                <h3>@lang('home.privacy')</h3>
                                <p class="text-muted">@lang('home.awesome_privacy').</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="feature-item">
                                <i class="fa fa-pie-chart bg-gradient-theme"></i>
                                <h3>@lang('home.dashboard')</h3>
                                <p class="text-muted">@lang('home.awesome_dashboard').</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="feature-item">
                                <i class="fa fa-credit-card bg-gradient-theme"></i>
                                <h3>@lang('home.accounts')</h3>
                                <p class="text-muted">@lang('home.awesome_accounts').</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="feature-item">
                                <i class="fa fa-money bg-gradient-theme"></i>
                                <h3>@lang('home.currencies')</h3>
                                <p class="text-muted">@lang('home.awesome_currencies').</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="feature-item">
                                <i class="fa fa-database bg-gradient-theme"></i>
                                <h3>@lang('home.groups')</h3>
                                <p class="text-muted">@lang('home.awesome_groups').</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="feature-item">
                                <i class="fa fa-exchange bg-gradient-theme"></i>
                                <h3>@lang('home.transactions')</h3>
                                <p class="text-muted">@lang('home.awesome_transactions').</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent

    <section class="cta">
        <div class="cta-content">
            <div class="container">
                <h2>@lang('home.stop_waiting').<br>
                    @lang('home.create_wallet')
                    {{ config('app.name') }}.
                </h2>
                <a href="{{ locale_route('register.show') }}" class="btn btn-outline btn-xl js-scroll-trigger border-radius-theme bounce-theme">
                    <i class="fa fa-user-circle-o"></i>
                    @lang('auth.register')
                </a>
            </div>
        </div>
        <div class="overlay"></div>
    </section>

    @component('components.home.gradient', ['id' => 'contact'])
        <h2>@lang('home.join_us') <i class="fa fa-smile-o text-dark"></i>.</h2>
        <ul class="list-inline list-social">
            <li class="list-inline-item social-twitter">
                <a href="#">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li class="list-inline-item social-facebook">
                <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item social-google-plus">
                <a href="#">
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>
            <li class="list-inline-item social-youtube">
                <a href="#">
                    <i class="fa fa-youtube-play"></i>
                </a>
            </li>
        </ul>
    @endcomponent
@endsection

@push('home.style.plugin')
    <link rel="stylesheet" href="{{ css_asset('device-mockups/device-mockups.min') }}" type="text/css">
@endpush