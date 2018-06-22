@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.our_products')))
@section('overlay_text', trans('general.products'))
@section('overlay_font', font('shopping-basket'))

@section('app.home.body')
    <!--Start Shop Area-->
    <div class="shop-product-area section fix">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="shop-sidebar fix">
                        <!-- single-sidebar start -->
                        <div class="sin-shop-sidebar shop-category">
                            <h2>@lang('general.category')</h2>
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="javascript: void(0);" title="{{ $category->slug }}" @click="productFilterByTitle('category', $event)"
                                           class="{{ $filter['category'] === $category->slug ? 'active_filter' : '' }}">
                                            {{ $category->format_name }}
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="javascript: void(0);" title="no_category" @click="productFilterByTitle('category', $event)"
                                       class="{{ $filter['category'] === 'no_category' || $filter['category'] === null ? 'active_filter' : '' }}">
                                        @lang('general.all_category')
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- single-sidebar end -->
                        <!-- single-sidebar start -->
                        <div class="sin-shop-sidebar product-price-range">
                            <h2>@lang('general.price')</h2>
                            <div class="slider-range-container">
                                <div id="slider-range"></div>
                                <p>
                                    <input type="text" id="price-amount" readonly
                                           min="{{ $filter['min_price'] }}" max="{{ $filter['max_price'] }}">
                                </p>
                            </div>
                        </div>
                        <!-- single-sidebar end -->
                        <!-- single-sidebar start -->
                        <div class="sin-shop-sidebar shop-tags">
                            <h2>@lang('general.tags')</h2>
                            <ul>
                                @foreach($tags as $tag)
                                    <li>
                                        <a href="javascript: void(0);" title="{{ $tag->slug }}" @click="productFilterByTitle('tag', $event)"
                                           class="{{ $filter['tag'] === $tag->slug ? 'active_filter' : '' }}">
                                            {{ $tag->format_name }}
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="javascript: void(0);" title="no_tag" @click="productFilterByTitle('tag', $event)"
                                        class="{{ $filter['tag'] === 'no_tag' || $filter['tag'] === null ? 'active_filter' : '' }}">
                                        @lang('general.all_tag')
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- single-sidebar end -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="shop-tool-bar col-sm-12 fix">
                            <div class="sort-by">
                                <span>@lang('general.sort_by')</span>
                                <select name="sort-by" @change="productFilterByValue('sort_by', $event)">
                                    <optgroup label="{{ mb_strtoupper(trans('general.price')) }}">
                                        <option {{ $filter['sort_by'] === \App\Models\Product::SORT_BY_PRICE_ASC ? 'selected' : '' }}
                                                value="{{ \App\Models\Product::SORT_BY_PRICE_ASC }}">
                                            @lang('general.ascendant_element', ['element' => trans('general.price')])
                                        </option>
                                        <option {{ $filter['sort_by'] === \App\Models\Product::SORT_BY_PRICE_DESC ? 'selected' : '' }}
                                                value="{{ \App\Models\Product::SORT_BY_PRICE_DESC }}">
                                            @lang('general.descendant_element', ['element' => trans('general.price')])
                                        </option>
                                    </optgroup>
                                    <optgroup label="{{ mb_strtoupper(trans('general.ranking')) }}">
                                        <option {{ $filter['sort_by'] === \App\Models\Product::SORT_BY_RANKING_ASC ? 'selected' : '' }}
                                                value="{{ \App\Models\Product::SORT_BY_RANKING_ASC }}">
                                            @lang('general.ascendant_element', ['element' => trans('general.ranking')])
                                        </option>
                                        <option {{ $filter['sort_by'] === \App\Models\Product::SORT_BY_RANKING_DESC ? 'selected' : '' }}
                                                value="{{ \App\Models\Product::SORT_BY_RANKING_DESC }}">
                                            @lang('general.descendant_element', ['element' => trans('general.ranking')])
                                        </option>
                                    </optgroup>
                                    <optgroup label="{{ mb_strtoupper(trans('general.name')) }}">
                                        <option {{ $filter['sort_by'] === \App\Models\Product::SORT_BY_NAME_ASC ? 'selected' : '' }}
                                                value="{{ \App\Models\Product::SORT_BY_NAME_ASC }}">
                                            @lang('general.ascendant_element', ['element' => trans('general.name')])
                                        </option>
                                        <option {{ $filter['sort_by'] === \App\Models\Product::SORT_BY_NAME_DESC ? 'selected' : '' }}
                                                value="{{ \App\Models\Product::SORT_BY_NAME_DESC }}">
                                            @lang('general.descendant_element', ['element' => trans('general.name')])
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="show-product">
                                <span>@lang('general.display')</span>
                                <select name="sort-by" @change="productFilterByValue('products_per_page', $event)">
                                    <option value="3" {{ $filter['products_per_page'] === '3' ? 'selected' : '' }}>3</option>
                                    <option value="9" {{ $filter['products_per_page'] === '9' ? 'selected' : '' }}>9</option>
                                    <option value="15" {{ $filter['products_per_page'] === '15' ? 'selected' : '' }}>15</option>
                                    <option value="21" {{ $filter['products_per_page'] === '21' ? 'selected' : '' }}>21</option>
                                </select>
                                <span>@lang('general.products_per_page')</span>
                            </div>
                        </div>
                        <div class="shop-products">
                            @component('components.app.pagination',
                                ['paginationTools' => $paginationTools])
                            @endcomponent
                            @forelse($paginationTools->displayItems as $product)
                                <div class="col-sm-4 fix">
                                    @component('components.app.product-card', [
                                        'product' => $product
                                        ])
                                    @endcomponent
                                </div>
                            @empty
                                <div class="col-sm-12 fix alert alert-info text-center">
                                    @lang('general.no_products')
                                </div>
                            @endforelse
                            @component('components.app.pagination', [
                                'paginationTools' => $paginationTools,
                                'url' => locale_route('products.index') . '?page='
                                ])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Start Shop Area-->
@endsection

@push('overlay.app.script.page')
    <script src="{{ js_asset('product-filter') }}" type="text/javascript"></script>
@endpush