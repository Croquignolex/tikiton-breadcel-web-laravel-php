<!--Start Header Top Area-->
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="info">
                    @component('components.top-header-info', [
                        'class' => 'phn-num', 'icon' => 'phone',
                        'label' => config('company.phone_1')
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
                        'icon' => 'facebook', 'link' => config('company.facebook'),
                        'title' => 'goto_facebook'
                        ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'twitter', 'link' => config('company.twitter'),
                        'title' => 'goto_twitter'
                        ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'linkedin', 'link' => config('company.linked_in'),
                        'title' => 'goto_linked_in'
                         ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'google-plus', 'link' => config('company.google_plus'),
                        'title' => 'goto_google_plus'
                        ])
                    @endcomponent
                    @component('components.icon-link', [
                        'icon' => 'youtube-play', 'link' => config('company.youtube'),
                        'title' => 'goto_youtube'
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