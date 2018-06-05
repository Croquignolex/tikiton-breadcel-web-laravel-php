<!--Start Header Top Area-->
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="info">
                    @component('components.app.top-header-info', [
                        'class' => 'phn-num', 'icon' => 'phone',
                        'label' => config('company.phone_1')
                        ])
                    @endcomponent
                    @component('components.app.top-header-info', [
                        'class' => 'mail-id', 'icon' => 'envelope-o',
                        'label' => config('company.email_1')
                        ])
                    @endcomponent
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="socials text-center">
                    @component('components.app.icon-link', [
                        'icon' => 'facebook', 'link' => config('company.facebook')
                        ])
                    @endcomponent
                    @component('components.app.icon-link', [
                        'icon' => 'twitter', 'link' => config('company.twitter')
                        ])
                    @endcomponent
                    @component('components.app.icon-link', [
                        'icon' => 'linkedin', 'link' => config('company.linked_in')
                         ])
                    @endcomponent
                    @component('components.app.icon-link', [
                        'icon' => 'google-plus', 'link' => config('company.google_plus')
                        ])
                    @endcomponent
                    @component('components.app.icon-link', [
                        'icon' => 'youtube-play', 'link' => config('company.youtube')
                        ])
                    @endcomponent
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div id="top-menu" class="float-right">
                    <ul>
                        @if(Auth::user())
                            @include('partials.header-top-user')
                        @endif
                        @include('partials.header-top-language')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header Top Area-->