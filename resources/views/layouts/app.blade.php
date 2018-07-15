@extends('master')

@section('title')
    @yield('home.title')
@endsection

@section('body')
    @include('partials.header-top')
    @include('partials.header')
    @include('partials.menu')
    @yield('home.body')
    @include('partials.footer-top')
    @include('partials.footer')
@endsection

@push('style.plugin')
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ css_asset('bootstrap.min') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('owl.carousel.min') }}" type="text/css">
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
    <script src="{{ js_asset('jquery.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('bootstrap.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('owl.carousel.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.countTo') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.mixitup.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.magnific-popup.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.appear') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.meanmenu.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.nivo.slider.pack') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.scrollup.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery.simpleLens.min') }}" type="text/javascript"></script>
    <script src="{{ js_asset('jquery-price-slider') }}" type="text/javascript"></script>
    <script src="{{ js_asset('wow.min') }}" type="text/javascript"></script>
    <script>
        new WOW().init();
    </script>
@endpush

@push('script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('app') }}" type="text/javascript"></script>
    @stack('app.script.page')
@endpush