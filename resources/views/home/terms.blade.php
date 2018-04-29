@extends('layouts.home.information')

@section('information.home.title', page_title(trans('general.terms_of_uses')))

@section('information.home.body')
    <h1 class="text-uppercase text-dark"><u>@lang('general.terms_of_uses')</u></h1><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.terms_and_conditions')</u></strong><br>
    @lang('home.terms_and_conditions_desc_1', ['app' => config('app.name')])<br>
    @lang('home.terms_and_conditions_desc_2', ['app' => config('app.name')])<br>
    @lang('home.terms_and_conditions_desc_3', ['app' => config('app.name')])<br><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.site_uses')</u></strong><br>
    @lang('home.site_uses_desc_1', ['app' => config('app.name')])<br>
    @lang('home.site_uses_desc_2', ['app' => config('app.name'), 'company'  => config('company.name')])<br>
    @lang('home.site_uses_desc_3', ['app' => config('app.name')])<br><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.liability_limitation')</u></strong><br>
    @lang('home.liability_limitation_desc_1', ['app' => config('app.name')])<br>
    @lang('home.liability_limitation_desc_2', ['app' => config('app.name')])<br><br>
    <strong class="text-uppercase text-theme"><u>@lang('home.indemnification')</u></strong><br>
    @lang('home.indemnification_desc', ['app' => config('app.name')])
@endsection