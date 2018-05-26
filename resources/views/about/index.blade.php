@extends('layouts.app.overlay')

@section('app.home.title', page_title(trans('general.about_us')))
@section('overlay', trans('general.about_us'))

@section('app.home.body')
    @component('components.app.about-section')
        <div class="col-sm-12">
            <div class="about-title">
                <h2>
                    @lang('general.welcome_on')
                    <span>{{ config('app.name') }}</span>
                </h2>
                <h3>{{ config('company.slogan') }}</h3>
            </div>
            <div class="about-text">
                <p>@lang('about.section_top')</p>
                @component('components.app.about-row-body',
                    ['body' => 'about_manager_1'])
                @endcomponent
            </div>
        </div>
        <div class="col-sm-6">
            <div class="about-text">
                <h2>
                    @lang('general.why')
                    <span>@lang('general.choose_us')</span>
                </h2>
                <p class="about-margin">@lang('about.section_bottom')</p>
                @component('components.app.about-row-body',
                    ['body' => 'about_manager_2'])
                @endcomponent
            </div>
        </div>
        <div class="col-sm-6">
            <div class="about-img">
                <img src="{{ banner_img_asset('about_bg') }}" alt="" />
            </div>
        </div>
    @endcomponent
@endsection