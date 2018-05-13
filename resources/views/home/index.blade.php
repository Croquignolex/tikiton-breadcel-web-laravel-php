@extends('layouts.app')

@section('home.title', page_title(trans('general.home')))

@section('home.body')
    <!--Start home slider-->
    <div class="slider-wrap home-1-slider">
        <div id="mainSlider" class="nivoSlider slider-image">
            @for($i = 1; $i <= 3; $i++)
                <img src="{{ img_asset('banners/banner' . $i , 'jpg') }}" alt="main slider" title="#slide{{ $i }}"/>
            @endfor
        </div>
        @for($i = 1; $i <= 3; $i++)
            <div id="slide{{ $i }}" class="nivo-html-caption slider-caption-{{ $i }}">
                <div class="slider-progress"></div>
                <div class="slide{{ $i }}-text slide-text">
                    <div class="middle-text">
                        <div class="cap-title wow {{ banner_animation($i - 1, 0) }}" data-wow-duration=".9s" data-wow-delay="0s">
                            <h1>{{ banner_message($i - 1, 0) }}</h1>
                        </div>
                        <div class="cap-dec wow {{ banner_animation($i - 1, 1) }}" data-wow-duration="1.3s" data-wow-delay="1s">
                            <h2>{{ banner_message($i - 1, 1) }}</h2>
                        </div>
                        <div class="cap-readmore wow {{ banner_animation($i - 1, 2) }}" data-wow-duration="1.5s" data-wow-delay="0s">
                            <a href="#">@lang('general.order')</a>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <!--End home slider-->
@endsection