@extends('layouts.app')

@section('home.title', page_title(trans('general.home')))

@section('home.body')
    <!--Start home slider-->
    <div class="slider-wrap home-1-slider">
        <div id="mainSlider" class="nivoSlider slider-image">
            @for($i = 1; $i <= 3; $i++)
                <img src="{{ banner_img_asset('banner' . $i) }}" alt="main slider" title="#slide{{ $i }}"/>
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
                            <a href="{{ locale_route('products.index') }}">@lang('general.order')</a>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <!--End home slider-->
    <!--Start Featured Product Area-->
    <div class="featured-product section fix">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>@lang('general.featured_products')</h2>
                    <div class="underline"></div>
                </div>
                <div class="col-sm-12">
                    <!-- Featured slider Area Start -->
                    <div class="feature-pro-slider owl-carousel">
                        @foreach($featured_products as $product)
                            @component('components.app.product-card',
                                ['product' => $product])
                            @endcomponent
                        @endforeach
                    </div>
                    <!-- Featured slider Area End -->
                </div>
            </div>
        </div>
    </div>
    <!--End Featured Product Area-->
    <!--Start Product Offer Area-->
    <div class="banner-area fix">
        <div class="col-sm-6 sin-banner">
            <a href="{{ locale_route('products.index') }}">
                <img src="{{ banner_img_asset('offer_top1') }}" alt="..." />
                <div class="wrap">
                    <h2>@lang('home.offer_top1_title')</h2>
                    <p>@lang('home.offer_top1_description')</p>
                </div>
            </a>
        </div>
        <div class="col-sm-4 sin-banner">
            <a href="{{ locale_route('products.index') }}">
                <img src="{{ banner_img_asset('offer_top2') }}" alt="..." />
                <div class="wrap">
                    <h2>@lang('home.offer_top2_title')</h2>
                    <p>@lang('home.offer_top2_description')</p>
                </div>
            </a>
        </div>
        <div class="col-sm-2 hidden-xs sin-banner text-1">
            <img src="{{ banner_img_asset('banner_bg') }}" alt="..." />
            <div class="banner-text">
                <a href="{{ locale_route('products.index') }}">@lang('general.order')</a>
            </div>
        </div>
        <div class="col-sm-2 hidden-xs sin-banner clear text-2">
            <img src="{{ banner_img_asset('banner_bg') }}" alt="..." />
            <div class="banner-text">
                <a href="{{ locale_route('products.index') }}">@lang('general.order')</a>
            </div>
        </div>
        <div class="col-sm-6 sin-banner">
            <a href="{{ locale_route('products.index') }}">
                <img src="{{ banner_img_asset('offer_bottom1') }}" alt="..." />
                <div class="wrap">
                    <h2>@lang('home.offer_bottom1_title')</h2>
                    <p>@lang('home.offer_bottom1_description')</p>
                </div>
            </a>
        </div>
        <div class="col-sm-4 sin-banner">
            <a href="{{ locale_route('products.index') }}">
                <img src="{{ banner_img_asset('offer_bottom2') }}" alt="..." />
                <div class="wrap">
                    <h2>@lang('home.offer_bottom2_title')</h2>
                    <p>@lang('home.offer_bottom2_description')</p>
                </div>
            </a>
        </div>
    </div>
    <!--End Product Offer Area-->
    <!--Start Product Area-->
    <div class="tab-product-area section fix">
        <div class="container">
            <div class="row">
                <!-- Nav tabs -->
                <ul class="tabs-list" role="tablist">
                    <li class="active"><a href="#new" data-toggle="tab">@lang('general.new')</a></li>
                    <li><a href="#feature" data-toggle="tab">@lang('general.featured')</a></li>
                    <li><a href="#b-sales" data-toggle="tab">@lang('general.best_sellers')</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="new">
                        <div class="tab-pro-slider new-product owl-carousel">
                            @for($i = 0; $i < $new_products->count(); $i += 2)
                                <div class="single-product-item fix">
                                    @component('components.app.product-card',
                                        ['product' => $new_products[$i]])
                                    @endcomponent
                                    @if($i + 1 < $new_products->count())
                                        @component('components.app.product-card',
                                            ['product' => $new_products[$i + 1]])
                                        @endcomponent
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="tab-pane fade" id="feature">
                        <div class="tab-pro-slider feature-product owl-carousel">
                            @for($i = 0; $i < $featured_products->count(); $i += 2)
                                <div class="single-product-item fix">
                                    @component('components.app.product-card',
                                        ['product' => $featured_products[$i]])
                                    @endcomponent
                                    @if($i + 1 < $featured_products->count())
                                        @component('components.app.product-card',
                                            ['product' => $featured_products[$i + 1]])
                                        @endcomponent
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="tab-pane fade" id="b-sales">
                        <div class="tab-pro-slider best-product owl-carousel">
                            @for($i = 0; $i < $most_sold_products->count(); $i += 2)
                                <div class="single-product-item fix">
                                    @component('components.app.product-card',
                                        ['product' => $most_sold_products[$i]])
                                    @endcomponent
                                    @if($i + 1 < $most_sold_products->count())
                                        @component('components.app.product-card',
                                            ['product' => $most_sold_products[$i + 1]])
                                        @endcomponent
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Product Area-->
    <!--Start Magic Area-->
    <div class="magic-area fix">
        <div class="col-sm-12 col-md-6 image">
            <a href="{{ locale_route('products.index') }}"><img src="{{ banner_img_asset('magic') }}" alt="..." height="348"/></a>
        </div>
        <div class="col-sm-12 col-md-6 content">
            <h2>@lang('home.magic_top_title')</h2>
            <h3>@lang('home.magic_title')</h3>
            <p>@lang('home.magic_description').</p>
            <a href="{{ locale_route('products.index') }}">@lang('general.order')</a>
        </div>
    </div>
    <!--End Magic Area-->
    <!--Start Fun Factor Area-->
    <div class="funfact section fix">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>@lang('general.our_statistics')</h2>
                    <div class="underline"></div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="fun-factor">
                        <div class="fun-factor-in">
                            <i class="{{ font('users') }}"></i>
                        </div>
                        <p class="timer" data-from="0" data-to="{{ $customers }}"></p>
                        <h4>@lang('general.customers')</h4>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="fun-factor">
                        <div class="fun-factor-in">
                            <i class="{{ font('database') }}"></i>
                        </div>
                        <p class="timer" data-from="0" data-to="{{ $products }}"></p>
                        <h4>@lang('general.items')</h4>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="fun-factor">
                        <div class="fun-factor-in">
                            <i class="{{ font('file-text-o') }}"></i>
                        </div>
                        <p class="timer" data-from="0" data-to="{{ $orders }}"></p>
                        <h4>@lang('general.orders')</h4>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="fun-factor">
                        <div class="fun-factor-in">
                            <i class="{{ font('calendar-check-o') }}"></i>
                        </div>
                        <p class="timer" data-from="0" data-to="{{ $sales }}"></p>
                        <h4>@lang('general.sold_items')</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Start Fun Factor Area-->
    <!--Start Testimonial Area-->
    <div class="testimonial-area fix">
        <div class="overlay section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8">
                        <div class="testimonial-slider  owl-carousel">
                            <div class="testimonial-item">
                                <div class="image fix">
                                    <img src="img/testimonial/testimonial.jpg" alt="" />
                                </div>
                                <div class="content fix">
                                    <p>Lorem ipsum dolor sit amet, consectetur adiising elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                                    <h3>Zasika Williams</h3>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <div class="image fix">
                                    <img src="img/testimonial/testimonial.jpg" alt="" />
                                </div>
                                <div class="content fix">
                                    <p>Lorem ipsum dolor sit amet, consectetur adiising elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                                    <h3>Zasika Williams</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Testimonial Area-->
    <!--Start Brand Area-->
    <div class="brand-area section fix">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h2>Our Brands</h2>
                    <div class="underline"></div>
                </div>
                <div class="brand-slider owl-carousel">
                    <div class="brand-item"><img src="img/brand/brand-1.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-2.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-3.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-4.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-5.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-1.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-2.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-3.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-4.png" alt="" /></div>
                    <div class="brand-item"><img src="img/brand/brand-5.png" alt="" /></div>
                </div>
            </div>
        </div>
    </div>
    <!--End Brand Area-->
@endsection