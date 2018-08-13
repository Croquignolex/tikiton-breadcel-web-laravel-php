@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.about')))
@section('overlay_text', trans('general.about'))
@section('overlay_font', font('info-circle'))

@section('app.home.body')
    @component('components.about-section')
        <div class="col-sm-12">
            <div class="about-title">
                <h2>
                    @lang('general.welcome_on')
                    <span>{{ config('app.name') }}</span>
                </h2>
                <h3>{{ \App\Models\Setting::where('is_activated', true)->first()->slogan }}</h3>
            </div>
            <div class="about-text">
                <p>{{ $about->about_section_1_normal_zone }}</p>
                <blockquote>
                    <p class="text-justify">
                        {{ $about->fr_about_section_1_important_zone }}
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="about-text">
                <h2>
                    @lang('general.why')
                    <span>@lang('general.choose_us')</span>
                </h2>
                <p class="about-margin">{{ $about->about_section_2_normal_zone }}</p>
                <blockquote>
                    <p class="text-justify">
                        {{ $about->fr_about_section_2_important_zone }}
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="about-img">
                <img src="{{ $about->image_path }}" alt="" />
            </div>
        </div>
    @endcomponent
    <!--Start Team Area-->
    <section class="team-area page fix">
        <div class="container">
            <div class="row">
                <div class="section-title text-center">
                    <h2>@lang('general.our_team')</h2>
                    <div class="underline"></div>
                </div>
                @foreach($teams as $team)
                    @component('components.team-card', ['team' => $team])
                        @component('components.icon-link', [
                           'icon' => 'facebook', 'link' => $team->facebook
                           ])
                        @endcomponent
                        @component('components.icon-link', [
                           'icon' => 'twitter', 'link' => $team->twitter
                           ])
                        @endcomponent
                        @component('components.icon-link', [
                           'icon' => 'linkedin', 'link' => $team->linkedin
                           ])
                        @endcomponent
                        @component('components.icon-link', [
                           'icon' => 'google-plus', 'link' => $team->googleplus
                           ])
                        @endcomponent
                    @endcomponent
                @endforeach
            </div>
        </div>
    </section>
    <!--End Team Area-->
@endsection