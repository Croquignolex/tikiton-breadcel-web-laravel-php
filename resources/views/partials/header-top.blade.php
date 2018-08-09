<!--Start Header Top Area-->
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="info">
                    @component('components.top-header-info', [
                        'class' => 'phn-num', 'icon' => 'phone',
                        'label' => \App\Models\Setting::where('is_activated', true)->first()->phone_1
                        ])
                    @endcomponent
                    @component('components.top-header-info', [
                        'class' => 'mail-id', 'icon' => 'envelope-o',
                        'label' => config('company.email_1')
                        ])
                    @endcomponent
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="socials text-center">
                    @component('components.icon-link', [
                        'icon' => 'facebook', 'link' => \App\Models\Setting::where('is_activated', true)->first()->facebook,
                        'title' => trans('general.goto_facebook')
                        ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'twitter', 'link' => \App\Models\Setting::where('is_activated', true)->first()->twitter,
                        'title' => trans('general.goto_twitter')
                        ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'linkedin', 'link' => \App\Models\Setting::where('is_activated', true)->first()->linkedin,
                        'title' => trans('general.goto_linked_in')
                         ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'google-plus', 'link' => \App\Models\Setting::where('is_activated', true)->first()->googleplus,
                        'title' =>  trans('general.goto_google_plus')
                        ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'youtube-play', 'link' => \App\Models\Setting::where('is_activated', true)->first()->youtube,
                        'title' => trans('general.goto_youtube')
                        ])
                    @endcomponent
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div id="top-menu" class="float-right">
                    <ul>
                        @auth
                            @include('partials.header-top-user')
                        @endauth
                        @include('partials.header-top-language')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header Top Area-->