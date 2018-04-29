@extends('layouts.master')

@section('title')
    @yield('home.title')
@endsection

@section('body')
    <div id="scrollUp" class="bounce-theme">
        <a href="#page-top" class="js-scroll-trigger">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
    @yield('home.body')
    @include('partials.footer')
@endsection

@push('style.plugin')
    @stack('home.style.plugin')
@endpush

@push('style.page')
    <link rel="stylesheet" href="{{ css_asset('home') }}" type="text/css">
@endpush

@push('script.plugin')
    <script src="{{ js_asset('jquery.easing.min') }}" type="text/javascript"></script>
@endpush

@push('script.page')
    <script src="{{ js_asset('home') }}" type="text/javascript"></script>
@endpush