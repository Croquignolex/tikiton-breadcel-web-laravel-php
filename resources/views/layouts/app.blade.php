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
    <!-- Site info -->
    <meta name="description" content="Bread'Cel est votre boulangerie artisanale préférée. Avec Bread'Cel vous avez un rapport qualité prix exceptionnel. Laissez-vous porter par les saveurs divines de Bread'Cel." />
    <meta name="keywords" content="pâtisserie,pastry,cake,gâteau,pain,miel,sucre,vanille,chocolat,honey,chocolate,sugar,bread,breadcel,flour,farine,blé,gingembre,ginger,margarine,lait,sel,milk,sault,sésame,pavot,lin,sesame,poppy,oeuf,egg,beurre,butter,oil,huile,bretzel,brioche,baguette,mayonaise,boulangerie,artisanale,bakery,craft,ville-marie,quebec,canda" />
    <meta name="dcterms.publisher" content="Bread'Cel" />
    <meta name="dcterms.modified" title="W3CDTF" content="{{ now() }}">
    <meta name="dcterms.title" content="@yield('home.title')" />
    <meta name="dcterms.subject" title="scheme" content="pâtisserie,pastry,cake,gâteau,pain,miel,sucre,vanille,chocolat,honey,chocolate,sugar,bread,breadcel,flour,farine,blé,gingembre,ginger,margarine,lait,sel,milk,sault,sésame,pavot,lin,sesame,poppy,oeuf,egg,beurre,butter,oil,huile,bretzel,brioche,baguette,mayonaise,boulangerie,artisanale,bakery,craft,ville-marie,quebec,canda" />
    <meta name="dcterms.language" title="ISO639-2" content="{{ App::getLocale() }}" />
    <meta property="og:locale" content="{{ App::getLocale() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('home.title')" />
    <meta property="og:updated_time" content="{{ now() }}" />
    <meta property="og:description" content="Bread'Cel est votre boulangerie artisanale préférée. Avec Bread'Cel vous avez un rapport qualité prix exceptionnel. Laissez-vous porter par les saveurs divines de Bread'Cel." />
    <meta property="og:site_name" content="Bread'Cel" />
    <meta property="og:image" content="{{ favicon_img_asset('favicon-32x32') }}" />
    <meta property="og:url" content="http://breadcel.ca/" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Bread'Cel est votre boulangerie artisanale préférée. Avec Bread'Cel vous avez un rapport qualité prix exceptionnel. Laissez-vous porter par les saveurs divines de Bread'Cel." />
    <meta name="twitter:title" content="@yield('home.title')" />
    <meta name="twitter:image" content="{{ img_asset('logo') }}" />
    <meta name="twitter:site" content="@breadcel">
    <link rel="shortcut icon" href="{{ favicon_img_asset('favicon-32x32') }}" />
    <link rel="apple-touch-icon" href="{{ img_asset('logo') }}" />  
    <meta name="google-site-verification" content="google5a1972c41b2ad0da" />
    <meta name="google" content="noimageindex">
    <meta name="google" content="notranslate" />
    <meta name="robots" content="noarchive">
    <meta name="robots" content="noodp">
    <meta name="robots" content="noydir">
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