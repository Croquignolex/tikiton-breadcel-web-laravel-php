@section('title')
    @yield('app.title')
@endsection

@section('body')
    @yield('app.body')
@endsection

@push('meta.form')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('style.plugin')
    @stack('app.style.plugin')
@endpush

@push('style.page')
    @stack('app.style.page')
@endpush

@push('script.plugin')
    @stack('app.script.plugin')
@endpush

@push('script.page')
    @stack('app.script.page')
@endpush









<!DOCTYPE html>

<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="nounext wallet for wallet and budget management">
    <meta name="author" content="Alexy xaxa">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ css_asset('bootstrap.min') }}" type="text/css">
    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="{{ css_asset('font-awesome.min') }}" type="text/css">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ css_asset('animate') }}" type="text/css">
@stack('style.page')
<!-- Custom styles for this page -->
    <link rel="stylesheet" href="{{ css_asset('master') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_asset('home') }}" type="text/css">

    <!--<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">-->

    <!-- Favicons -->
    <link rel="icon" href="{{ favicon_img_asset('favicon-32x32') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ favicon_img_asset('favicon-16x16') }}" sizes="16x16" type="image/png">
</head>

<body id="page-top">
<div id="loader"></div>
<div id="scrollUp" class="bounce-theme">
    <a href="#page-top" class="js-scroll-trigger">
        <i class="fa fa-angle-up"></i>
    </a>
</div>

@yield('content')

@include('partials.footer')

<!-- Bootstrap core JavaScript -->
<script src="{{ js_asset('jquery.min') }}" type="text/javascript"></script>
<script src="{{ js_asset('bootstrap.min') }}" type="text/javascript"></script>
<!-- Plugin JavaScript -->
<script src="{{ js_asset('jquery.easing.min') }}" type="text/javascript"></script>
<!-- Custom scripts for this page -->
<script src="{{ js_asset('master') }}" type="text/javascript"></script>
<script src="{{ js_asset('home') }}" type="text/javascript"></script>
</body>
</html>