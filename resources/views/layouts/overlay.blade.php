@extends('layouts.app')

@section('home.title')
    @yield('app.home.title')
@endsection

@section('home.body')
    <!--Start Title-->
    <div class="page-title fix">
        <div class="overlay section">
            <h2>
                <i class="@yield('overlay_font')"></i>
                @yield('overlay_text')
            </h2>
        </div>
    </div>
    <!--End Title-->
    @yield('app.home.body')
@endsection

@push('app.script.page')
    @stack('overlay.app.script.page')
@endpush