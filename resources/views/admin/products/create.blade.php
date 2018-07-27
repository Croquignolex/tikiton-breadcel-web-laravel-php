@extends('admin.layouts.admin')

@section('home.title', page_title('Nouveau produit'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                         Nouveau produit
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.products.store') }}"
                          @submit="validateFormElements" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_name', 'label' => 'fr_name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_name', 'class' => 'form-control',
                                             'value' => old('fr_name'), 'auto_focus' => 'autofocus'
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
                                             'value' => old('en_name')
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
                                             'value' => old('price'), 'minlength' => 1
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
                                             'value' => old('discount') ?? 0, 'minlength' => 1
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
                                             'value' => old('stock') ?? 0, 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'category', 'label' => 'category'
                                       ])
                                        @component('components.select', [
                                            'name' => 'category', 'class' => 'form-control', 'title' => 'Choisir la catégorie',
                                             'value' => old('category'), 'options' => \App\Models\ProductCategory::all()
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'tags', 'label' => 'tags'
                                       ])
                                        @component('components.multi-select', [
                                            'name' => 'tags', 'class' => 'form-control', 'title' => 'Sélectionner les étiquettes',
                                             'values' => old('tags') ?? [], 'options' => \App\Models\Tag::all()
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="featured" id="featured"
                                               title="Placer le produit en vedette" {{ old('featured') === 'on' ? 'checked' : '' }}>
                                        <label class="badge badge-theme" title="Placer le produit en vedette">
                                            <i class="{{ font('database') }}"></i>
                                            <i class="{{ font('star') }}"></i>
                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" class="form-check-input" name="best_sale" id="best_sale"
                                               title="Placer le produit en meilleur vente" {{ old('best_sale') === 'on' ? 'checked' : '' }}>
                                        <label class="badge badge-info" title="Placer le produit en meilleur vente">
                                            <i class="{{ font('database') }}"></i>
                                            <i class="{{ font('gift') }}"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'fr_description', 'label' => 'fr_description'
                                        ])
                                        @component('components.textarea', [
                                            'name' => 'fr_description', 'value' => old('fr_description'),
                                            'class' => 'form-control'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_description', 'label' => 'en_description'
                                       ])
                                        @component('components.textarea', [
                                            'name' => 'en_description', 'value' => old('en_description'),
                                            'class' => 'form-control'
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
                                       'class' => 'btn btn-secondary', 'value' => 'Ajouter',
                                       'title' => 'Créer ce produit'
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