@extends('layouts.home.information')

@section('information.home.title', page_title(trans('general.privacy_policy')))

@section('information.home.body')
    <h1 class="text-uppercase text-dark"><u>@lang('general.privacy_policy')</u></h1><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.our_policy')</u></strong><br>
    @lang('home.our_policy_desc', ['app' => config('app.name')])<br><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.information_we_collect')</u></strong><br>
    @lang('home.information_we_collect_desc', ['app' => config('app.name')])<br><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.security')</u></strong><br>
    @lang('home.security_desc', ['app' => config('app.name')])<br><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.access_to_information')</u></strong><br>
    @lang('home.access_to_information_desc', ['app' => config('app.name'), 'support' => config('company.support')])
@endsection