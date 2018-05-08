<!--Start Header Top Area-->
<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="info">
                    @component('components.app.top-header-info',
                        ['class' => 'phn-num', 'icon' => 'phone' ])
                        phone
                    @endcomponent
                    @component('components.app.top-header-info',
                        ['class' => 'mail-id', 'icon' => 'envelope-o' ])
                        email
                    @endcomponent
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="socials text-center">
                    @component('components.app.top-header-social',
                        ['icon' => 'facebook' ])
                        facebook
                    @endcomponent
                    @component('components.app.top-header-social',
                    ['icon' => 'twitter' ])
                        twitter
                    @endcomponent
                    @component('components.app.top-header-social',
                    ['icon' => 'linkedin' ])
                        linked_in
                    @endcomponent
                    @component('components.app.top-header-social',
                    ['icon' => 'google-plus' ])
                        google_plus
                    @endcomponent
                    @component('components.app.top-header-social',
                    ['icon' => 'youtube-play' ])
                        youtube
                    @endcomponent
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div id="top-menu" class="float-right">
                    <ul>
                        <!--<li><a href="">My Account</a></li>-->
                        @include('partials.app.language')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header Top Area-->