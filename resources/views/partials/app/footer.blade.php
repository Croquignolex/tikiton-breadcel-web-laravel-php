<!--Start Footer Area-->
<div class="footer-area fix">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="copy-right">
                    <p>&copy; 2018 {{ config('app.name') }}, @lang('general.right').</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="payment">
                    <ul>
                        <li><a href="{{ locale_route('terms') }}">@lang('general.terms_of_uses')</a></li>
                        <li><a href="{{ locale_route('policy') }}">@lang('general.privacy_policy')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Footer Area-->