@extends('master')

@section('title')
    @yield('home.title')
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="come-logo">
                    <a href="{{ locale_route('home') }}" title="@lang('general.home')">
                        <img src="{{ img_asset('logo') }}" alt="..." />
                    </a>
                </div>
                <div class="comming-soon-text text-center">
                    <h2 class="error-code">@yield('error.code')</h2>
                    <div class="come-soon">
                        <h4 class="text-uppercase">@yield('error.title')</h4>
                        <div class="come-border">
                            <div class="come-bottom float-left"></div>
                            <i class="{{ font('times') }} float-left"></i>
                            <div class="come-bottom float-left"></div>
                        </div>
                        <h4>@yield('error.body')</h4>
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
                    <div class="login">
                        <a href="{{ locale_route('home') }}"
                           class="btn btn-lg btn-theme"
                           title="@lang('general.home')">
                            <i class="{{ font('home') }}"></i>
                            @lang('error.return')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style.plugin')
    <link rel="stylesheet" href="{{ css_asset('bootstrap.min') }}" type="text/css">
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

@push('script.plugin')
    <!-- Bootstrap core JavaScript -->
    <<script src="{{ js_asset('jquery.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('bootstrap.min') }}" type="text/javascript"></script>
@endpush