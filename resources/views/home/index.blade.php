@extends('layouts.app.app')

@section('home.title', page_title(trans('general.home')))

@section('home.body')
    @include('partials.app.banner')
@endsection