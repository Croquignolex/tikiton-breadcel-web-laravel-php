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
    <div class="featured-product section fix wishlist-heart">
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
                            @component('components.product-card', [
                                'product' => $product
                                ])
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
                    <li><a href="#featured" data-toggle="tab">@lang('general.featured')</a></li>
                    <li><a href="#b-sales" data-toggle="tab">@lang('general.best_sellers')</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="new">
                        <div class="tab-pro-slider new-product owl-carousel">
                            @foreach($new_products->chunk(2) as $chunk)
                                <div class="single-product-item fix">
                                    @foreach($chunk as $new_product)
                                        @component('components.product-card',
                                            ['product' => $new_product])
                                        @endcomponent
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="featured">
                        <div class="tab-pro-slider featured-product owl-carousel">
                            @foreach($featured_products->chunk(2) as $chunk)
                                <div class="single-product-item fix">
                                    @foreach($chunk as $featured_product)
                                        @component('components.product-card',
                                            ['product' => $featured_product])
                                        @endcomponent
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="b-sales">
                        <div class="tab-pro-slider best-product owl-carousel">
                            @foreach($most_sold_products->chunk(2) as $chunk)
                                <div class="single-product-item fix">
                                    @foreach($chunk as $most_sold_product)
                                        @component('components.product-card',
                                            ['product' => $most_sold_product])
                                        @endcomponent
                                    @endforeach
                                </div>
                            @endforeach
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
            <a href="{{ locale_route('products.index') }}"><img src="{{ banner_img_asset('magic') }}" alt="..." class="img-responsive"/></a>
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
                @component('components.fun-factor-item', [
                    'font' => 'users',
                    'value' => $customers_nbr,
                    'dictionary_name' => 'customers',
                    ])
                @endcomponent
                @component('components.fun-factor-item', [
                    'font' => 'database',
                    'value' => $products_nbr,
                    'dictionary_name' => 'items',
                    ])
                @endcomponent
                @component('components.fun-factor-item', [
                    'font' => 'file-text-o',
                    'value' => $orders_nbr,
                    'dictionary_name' => 'orders',
                    ])
                @endcomponent
                @component('components.fun-factor-item', [
                    'font' => 'calendar-check-o',
                    'value' => $sales_nbr,
                    'dictionary_name' => 'sold_items',
                    ])
                @endcomponent
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
                            @foreach($testimonials as $testimonial)
                                <div class="testimonial-item">
                                    <div class="image fix">
                                        <img src="{{ $testimonial->image_path }}" alt="" class="img-responsive" />
                                    </div>
                                    <div class="content fix">
                                        <h4 class="text-justify">{{ $testimonial->format_description }}</h4>
                                        <h3 class="text-right">{{ $testimonial->format_name }}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Testimonial Area-->
@endsection