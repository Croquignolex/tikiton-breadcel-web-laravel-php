@extends('layouts.home.home')

@section('home.title')
    @yield('information.home.title')
@endsection

@section('home.body')
    <!-- Navigation -->
    @component('components.home.navbar')
        @include('partials.home.nav-item')
    @endcomponent

    @component('components.home.header', ['class' => 'display'])
        <div class="col-12" >
            @yield('information.home.body')
        </div>
    @endcomponent

    @include('partials.home.contact')
@endsection