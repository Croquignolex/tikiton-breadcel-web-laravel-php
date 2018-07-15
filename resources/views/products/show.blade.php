@extends('layouts.overlay')

@section('app.home.title', page_title($product->format_name))
@section('overlay_text', trans('general.product'))
@section('overlay_font', font('shopping-bag'))

@section('app.home.body')
    <!--Start Product Details Area-->
    <section class="product-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="details-pro-tab">
                        <!-- Tab panes -->
                        <div class="tab-content details-pro-tab-content">
                            <div class="tab-pane fade in active" id="image">
                                <div class="simpleLens-big-image-container">
                                    <a class="simpleLens-lens-image {{ $product->stock === 0 ? 'out-of-stock' : '' }}"
                                       data-lens-image="{{ $product->image_path }}">
                                        <img src="{{ $product->image_path }}" alt="" class="simpleLens-big-image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                <div class="col-sm-6">
                    <div class="shop-details">
                        <!-- Product Name -->
                        <h2> {{ $product->format_name }}</h2>
                        <!-- Product Ratting -->
                        @component('components.star-ranking',
                            ['ranking' => $product->ranking])
                        @endcomponent
                        <h3>
                            @if($product->discount === 0)
                                {{ money_currency($product->amount) }}
                            @else
                                <span>{{ money_currency($product->amount) }}</span>
                                {{ money_currency($product->new_price) }}
                            @endif
                        </h3>
                        <h4>{{ $product->product_reviews->count() }} @lang('general.reviews')</h4>
                        <h5>
                            @lang('general.availability') -
                            <span class="{{ $product->availability }}">
                                @lang('general.' . $product->availability)
                            </span>
                        </h5>
                        <div class="review contact-form">
                            @auth
                                @if(session()->has('notification.message'))
                                    <div class="text-center custom-alert-{{ session('notification.type') }} col-sm-offset-1">
                                        {{ session('notification.message') }}
                                    </div>
                                @endif
                                <form action="" method="POST" class="review-form" @submit="validateFormElements">
                                    {{ csrf_field() }}
                                    @component('components.textarea', [
                                        'name' => 'review', 'value' => old('review'),
                                        'placeholder' => trans('general.review_product')
                                        ])
                                    @endcomponent
                                    @component('components.submit', [
                                        'class' => 'submit', 'value' => trans('general.review'),
                                        'title' => trans('general.send_your_review')
                                        ])
                                    @endcomponent
                                    <div class="text-theme text-left">
                                        <star-ranking></star-ranking>
                                    </div>
                                </form>
                            @endauth
                            @guest
                                <div class="alert alert-danger">
                                    @lang('general.connect_to_review')
                                </div>
                            @endguest
                        </div>
                        <div class="action-btn">
                            @auth
                                @component('components.wish-list-icon-link', compact('product'))
                                @endcomponent
                                @component('components.cart-icon-link', compact('product'))
                                @endcomponent
                            @endauth
                            @guest
                                @component('components.guest-icon-link', [
                                    'class' => 'favorite',
                                    'icon' => 'heart',
                                    'locale_message' => 'connect_to_wish_list',
                                    'product_name' => $product->format_name
                                    ])
                                @endcomponent
                                @component('components.guest-icon-link', [
                                    'class' => 'add-cart',
                                    'icon' => 'shopping-cart',
                                    'locale_message' => 'connect_to_cart',
                                    'product_name' => $product->format_name
                                    ])
                                @endcomponent
                            @endguest
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 fix">
                    <div class="description">
                        <!-- Nav tabs -->
                        <ul class="nav product-nav">
                            <li class="active"><a data-toggle="tab" href="#description">@lang('general.description')</a></li>
                            <li class=""><a data-toggle="tab" href="#reviews">@lang('general.reviews')</a></li>
                            <li class=""><a data-toggle="tab" href="#tags">@lang('general.tags')</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade active in" role="tabpanel">
                                <p class="text-justify multi-line-text">{{ $product->format_description }}</p>
                            </div>
                            <div id="reviews" class="tab-pane fade" role="tabpanel">
                                @auth
                                    @forelse($product->product_reviews->sortByDesc('created_at') as $review)
                                        <div class="border-bottom-theme user-review">
                                            <ul>
                                                <li>
                                                    <i class="{{ font('user') }}"></i>
                                                    {{ $review->user->format_first_name }}
                                                    {{ $review->user->format_last_name }}
                                                </li>
                                                <li>
                                                    <i class="{{ font('clock-o') }}"></i>
                                                    {{ $review->created_time }}
                                                </li>
                                                <li>
                                                    <i class="{{ font('calendar') }}"></i>
                                                    {{ $review->created_date }}
                                                </li>
                                            </ul>
                                            <p class="text-justify multi-line-text">{{ $review->text }}</p>
                                            <p class="text-right">
                                                @component('components.star-ranking', [
                                                    'ranking' => $review->ranking,
                                                    'class' => 'text-theme text-right'
                                                    ])
                                                @endcomponent
                                            </p>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger">
                                            @lang('general.no_reviews')
                                        </div>
                                    @endforelse
                                @endauth
                                @guest
                                    <div class="alert alert-danger">
                                        @lang('general.connect_to_see_review')
                                    </div>
                                @endguest
                            </div>
                            <div id="tags" class="tab-pane fade" role="tabpanel">
                                @forelse($product->product_tags as $product_tag)
                                    <a href="{{ locale_route('products.index') . '?tag=' . $product_tag->tag->slug }}">{{ $product_tag->tag->format_name }}</a>
                                @empty
                                    <div class="alert alert-info">
                                        @lang('general.no_tags')
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 fix">
                    <div class="section-title">
                        <h2>@lang('general.related_products')</h2>
                        <div class="underline"></div>
                    </div>
                    <div class="related-pro-slider owl-carousel">
                        @foreach($product->related_products as $related_product)
                            @component('components.product-card', [
                                'product' => $related_product
                                ])
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Product Details Area-->
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
@endpush