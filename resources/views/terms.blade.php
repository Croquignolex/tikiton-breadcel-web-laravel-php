@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.terms_of_uses')))
@section('overlay', trans('general.terms_of_uses'))

@section('app.home.body')
    @component('components.about-section')
        @component('components.about-row', ['title' => 'terms_and_conditions'])
            @for($i = 1; $i <= 3; $i++)
                @component('components.about-row-body',
                    ['body' => 'terms_and_conditions_desc_' . $i])
                @endcomponent
            @endfor
        @endcomponent

        @component('components.about-row', ['title' => 'site_uses'])
            @for($i = 1; $i <= 3; $i++)
                @component('components.about-row-body',
                    ['body' => 'site_uses_desc_' . $i])
                @endcomponent
            @endfor
        @endcomponent

        @component('components.about-row', ['title' => 'liability_limitation'])
            @for($i = 1; $i <= 2; $i++)
                @component('components.about-row-body',
                    ['body' => 'liability_limitation_desc_' . $i])
                @endcomponent
            @endfor
        @endcomponent

        @component('components.about-row', ['title' => 'indemnification'])
            @component('components.about-row-body',
                ['body' => 'indemnification_desc'])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection