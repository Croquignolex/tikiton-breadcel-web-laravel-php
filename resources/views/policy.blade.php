@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.privacy_policy')))
@section('overlay', trans('general.privacy_policy'))

@section('app.home.body')
    @component('components.app.about-section')
        @component('components.app.about-row', ['title' => 'our_policy'])
            @component('components.app.about-row-body',
                ['body' => 'our_policy_desc'])
            @endcomponent
        @endcomponent

        @component('components.app.about-row', ['title' => 'information_we_collect'])
            @component('components.app.about-row-body',
                ['body' => 'information_we_collect_desc'])
            @endcomponent
        @endcomponent

        @component('components.app.about-row', ['title' => 'security'])
            @component('components.app.about-row-body',
                ['body' => 'security_desc'])
            @endcomponent
        @endcomponent

        @component('components.app.about-row', ['title' => 'access_to_information'])
            @component('components.app.about-row-body',
                ['body' => 'access_to_information_desc'])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection