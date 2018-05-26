@extends('layouts.app.app')

@section('home.title')
    @yield('app.home.title')
@endsection

@section('home.body')
    <!--Start Title-->
    <div class="page-title fix">
        <div class="overlay section">
            <h2>@yield('overlay')</h2>
        </div>
    </div>
    <!--End Title-->
    @yield('app.home.body')
@endsection