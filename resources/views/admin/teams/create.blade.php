@extends('admin.layouts.admin')

@section('home.title', page_title('Nouveau membre'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Nouveau membre
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.teams.index'),
                            'label' => 'Liste des membres'
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.teams.store') }}"
                          @submit="validateFormElements" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'name', 'label' => 'name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'name', 'class' => 'form-control',
                                             'value' => old('name'), 'auto_focus' => 'autofocus'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_function', 'label' => 'fr_function'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_function', 'class' => 'form-control',
                                             'value' => old('fr_function')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_function', 'label' => 'en_function'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_function', 'class' => 'form-control',
                                             'value' => old('en_function')
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'facebook', 'label' => 'facebook'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'facebook', 'class' => 'form-control',
                                             'value' => old('facebook'), 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'twitter', 'label' => 'twitter'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'twitter', 'class' => 'form-control',
                                             'value' => old('twitter'), 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'linkedin', 'label' => 'linkedin'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'linkedin', 'class' => 'form-control',
                                             'value' => old('linkedin'), 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'googleplus', 'label' => 'googleplus'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'googleplus', 'class' => 'form-control',
                                             'value' => old('googleplus'), 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
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
                                       'width' => 250, 'height' => 270
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Ajouter',
                                       'title' => 'Créer ce membre'
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