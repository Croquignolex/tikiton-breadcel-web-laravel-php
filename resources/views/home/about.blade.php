@extends('layouts.home.information')

@section('information.home.title', page_title(trans('general.about')))

@section('information.home.body')
    <h1 class="text-uppercase text-dark"><u>@lang('general.about')</u></h1><br>
    @lang('home.about_desc', ['app' => config('app.name')])
@endsection