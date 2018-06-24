@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_wish_list')))
@section('overlay_text', trans('general.wish_list'))
@section('overlay_font', font('star'))

@section('app.home.body')
    <!--Start Wishlist Area-->
    <section class="wishlist-page page fix">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table wishlist-table table-hover">
                            <thead class="table-title">
                                <tr>
                                    <th class="produ text-uppercase">@lang('general.product')</th>
                                    <th class="namedes text-uppercase">@lang('general.name') &amp; @lang('general.description')</th>
                                    <th class="unit text-uppercase">@lang('general.price')</th>
                                    <th class="valu text-uppercase">@lang('general.availability')</th>
                                    <th class="valu text-uppercase">@lang('general.cart')</th>
                                    <th class="acti text-uppercase">@lang('general.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wished_products as $wished_product)
                                    <tr class="table-info">
                                        <td class="produ">
                                            <a href="{{ locale_route('products.show', [$wished_product]) }}"
                                                    class="{{ $wished_product->stock === 0 ? 'out-of-stock' : '' }}">
                                                <img alt="..." src="{{ $wished_product->image_path }}">
                                            </a>
                                        </td>
                                        <td class="namedes">
                                            <h2>
                                                <a href="{{ locale_route('products.show', [$wished_product]) }}">
                                                    {{ $wished_product->format_name }}
                                                </a>
                                            </h2>
                                            <p>{{ $wished_product->format_description }}</p>
                                        </td>
                                        <td class="unit">
                                            @if($wished_product->discount === 0)
                                                <h5>{{ money_currency($wished_product->amount) }}</h5>
                                            @else
                                                <span class="old">{{ money_currency($wished_product->amount) }}</span>
                                                <br />
                                                <h5 class="new">{{ money_currency($wished_product->new_price) }}</h5>
                                            @endif
                                        </td>
                                        <td class="quantity {{ $wished_product->availability }}">
                                            @lang('general.' . $wished_product->availability)
                                        </td>
                                        <td class="valu">
                                            @if($wished_product->is_in_current_user_cart)
                                                <button class="btn btn-danger" title="@lang('general.remove_from_cart')" type="button"
                                                    onclick="document.getElementById('remove-product-{{ $wished_product->id }}').submit();">
                                                    <i class="{{ font('cart-arrow-down') }}"></i>
                                                    <small>
                                                        <i class="{{ font('sort-down') }}"></i>
                                                    </small>
                                                </button>
                                                <form id="remove-product-{{ $wished_product->id }}" method="POST" class="hidden"
                                                      action="{{ locale_route('account.remove.product.cart', [$wished_product]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @else
                                                <button class="btn btn-theme" title="@lang('general.add_to_cart')" type="button"
                                                    onclick="document.getElementById('add-product-{{ $wished_product->id }}').submit();">
                                                    <i class="{{ font('cart-plus') }}"></i>
                                                    <small>
                                                        <i class="{{ font('sort-up') }}"></i>
                                                    </small>
                                                </button>
                                                <form id="add-product-{{ $wished_product->id }}" method="POST" class="hidden"
                                                      action="{{ locale_route('account.add.product.cart', [$wished_product]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                </form>
                                            @endif
                                        </td>
                                        <td class="acti">
                                            <button class="btn btn-danger" type="button" data-toggle="modal"
                                                data-target="#remove-from-wish-list-{{ $wished_product->id }}"
                                                title="@lang('general.remove_from_wish_list')">
                                                <i class="{{ font('trash-o') }}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="table-info">
                                        <td colspan="6">
                                            <div class="alert alert-info text-center">
                                                @lang('general.empty_wish_list')
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Wishlist Area-->

    @foreach($wished_products as $wished_product)
        @component('components.modal', [
        'title' => trans('general.remove_from_wish_list'),
            'id' => 'remove-from-wish-list-' . $wished_product->id, 'color' => 'danger',
            'action_route' => locale_route('account.remove.product.wishlist', [$wished_product])
            ])
            @lang('general.remove_product_from_wish_list', ['product' => $wished_product->format_name]) ?
        @endcomponent
    @endforeach
@endsection