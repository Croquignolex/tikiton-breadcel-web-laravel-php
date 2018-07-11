<!--Start Header Area-->
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-lg-3">
                <div class="log-link">
                    <p>@lang('general.welcome_to_you')</p>
                    <h5>
                        @guest
                            <a href="{{ locale_route('login') }}">
                                <i class="{{ font('unlock') }}"></i>
                                @lang('general.login')
                            </a>
                            @lang('general.or')
                            <a href="{{ locale_route('register') }}">
                                <i class="{{ font('user-plus') }}"></i>
                                @lang('general.register')
                            </a>
                        @endguest
                        @auth
                            <a href="{{ locale_route('account.index') }}">
                                {{ \Illuminate\Support\Facades\Auth::user()->format_first_name }}
                                {{ \Illuminate\Support\Facades\Auth::user()->format_last_name }}
                            </a>
                        @endauth
                    </h5>
                </div>
            </div>
            <div class="col-sm-4 col-lg-6">
                <div class="logo text-center">
                    <a href="{{ locale_route('home') }}">
                        <img src="{{ img_asset('logo') }}" alt="..." />
                        <h4>{{ config('company.slogan') }}</h4>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-lg-3">
                @if(!Illuminate\Support\Facades\Route::is('cart.index') && !Illuminate\Support\Facades\Route::is('checkout.index'))
                    @auth
                        @include('partials.user-cart')
                    @endauth
                @endif
                <div class="search float-right">
                    <form action="{{ locale_route('search') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" value="" placeholder="@lang('general.search')...." />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header Area-->