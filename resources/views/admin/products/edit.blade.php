@extends('admin.layouts.admin')

@section('home.title', page_title($product->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        METTRE A JOUR
                        <strong class="text-theme">
                            {{ mb_strtoupper($product->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.products.index'),
                            'label' => 'Liste des produits'
                            ])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{ route('admin.products.update', [$product]) }}"
                          @submit="validateFormElements" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_name', 'label' => 'fr_name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_name', 'class' => 'form-control',
                                             'value' => old('fr_name') ?? $product->fr_name, 'auto_focus' => 'autofocus'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_name', 'label' => 'en_name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_name', 'class' => 'form-control',
                                             'value' => old('en_name') ?? $product->en_name
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'price', 'label' => 'price'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'price', 'class' => 'form-control',
                                             'value' => old('price') ?? $product->price, 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'discount', 'label' => 'discount'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'discount', 'class' => 'form-control',
                                             'value' => old('discount') ?? $product->discount, 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'stock', 'label' => 'stock'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'stock', 'class' => 'form-control',
                                             'value' => old('stock') ?? $product->stock, 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        @component('components.label-input', [
                                           'name' => 'category', 'label' => 'category'
                                           ])
                                            @component('components.select', [
                                                'name' => 'category', 'class' => 'form-control', 'title' => 'Sélectionner les étiquettes',
                                                 'value' => old('category') ?? $product->product_category->id, 'options' => \App\Models\ProductCategory::all()
                                                ])
                                            @endcomponent
                                        @endcomponent

                                    </div>
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'tags', 'label' => 'tags'
                                       ])
                                        @component('components.multi-select', [
                                            'name' => 'tags', 'class' => 'form-control', 'title' => 'Sélectionner les étiquettes',
                                             'values' => old('tags') ?? $tabTagIds, 'options' => \App\Models\Tag::all()
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="featured" id="featured"
                                                {{ $product->is_featured ? 'checked' : '' }}>
                                        <label class="badge badge-theme">En vedette</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" class="form-check-input" name="best_sale" id="best_sale"
                                                {{ $product->is_most_sold ? 'checked' : '' }}>
                                        <label class="badge badge-info">Meilleur vente</label>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" class="form-check-input" name="new" id="new"
                                                {{ $product->is_new ? 'checked' : '' }}>
                                        <label class="badge badge-success">Nouveau</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'fr_description', 'label' => 'fr_description'
                                        ])
                                        @component('components.textarea', [
                                            'name' => 'fr_description', 'class' => 'form-control',
                                            'value' => old('fr_description') ?? $product->fr_description
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_description', 'label' => 'en_description'
                                       ])
                                        @component('components.textarea', [
                                            'name' => 'en_description', 'class' => 'form-control',
                                            'value' => old('en_description') ?? $product->en_description
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 600, 'height' => 500
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Modifier',
                                       'title' => 'Mettre à jour ce produit'
                                       ])
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush