@extends('master')

@section('title')
    @yield('home.title')
@endsection

@section('body')
    @yield('home.body')
@endsection

@push('style.plugin')
    <link rel="stylesheet" href="{{ css_admin_asset('vendor.bundle.base') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_admin_asset('vendor.bundle.addons') }}" type="text/css">
    <link rel="stylesheet" href="{{ css_admin_asset('admin') }}" type="text/css">
@endpush

@push('style.page')
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
@endpush

@push('script.plugin')
    <script src="{{ js_admin_asset('vendor.bundle.base') }}" type="text/javascript"></script>
    <script src="{{ js_admin_asset('vendor.bundle.addons') }}" type="text/javascript"></script>
    <script src="{{ js_admin_asset('off-canvas') }}" type="text/javascript"></script>
    <script src="{{ js_admin_asset('misc') }}" type="text/javascript"></script>
@endpush

@push('script.page')
    <!-- Page scripts -->
    <script src="{{ js_admin_asset('admin') }}" type="text/javascript"></script>
    @stack('admin.script.page')
@endpush