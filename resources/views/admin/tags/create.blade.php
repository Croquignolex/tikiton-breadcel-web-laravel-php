@extends('admin.layouts.admin')

@section('home.title', page_title('Nouvelle étiquettes'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Nouvelle étiquette
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.tags.index'),
                            'label' => 'Liste des étiquettes'
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.tags.store') }}"
                          @submit="validateFormElements">
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
                                        'name' => 'fr_description', 'label' => 'fr_description'
                                        ])
                                        @component('components.textarea', [
                                            'name' => 'fr_description', 'value' => old('fr_description'),
                                            'class' => 'form-control'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                                    @component('components.label-input', [
                                       'name' => 'products', 'label' => 'products'
                                       ])
                                        @component('components.multi-select', [
                                            'name' => 'products', 'class' => 'form-control', 'title' => 'Sélectionner les produits',
                                             'values' => old('products') ?? [], 'options' => \App\Models\Product::all()
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Ajouter',
                                       'title' => 'Créer cette étiquette'
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