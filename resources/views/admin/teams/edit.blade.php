@extends('admin.layouts.admin')

@section('home.title', page_title($testimonial->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        METTRE A JOUR
                        <strong class="text-theme">
                            {{ mb_strtoupper($testimonial->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.testimonials.index'),
                            'label' => 'Liste des témoignages'
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.testimonials.update', [$testimonial]) }}"
                          @submit="validateFormElements" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_description', 'label' => 'fr_description'
                                       ])
                                        @component('components.textarea', [
                                            'name' => 'fr_description', 'class' => 'form-control',
                                            'value' => old('fr_description') ?? $testimonial->fr_description,
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
                                            'value' => old('en_description') ?? $testimonial->en_description,
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'name', 'label' => 'name'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'name', 'class' => 'form-control',
                                             'value' => old('name') ?? $testimonial->format_name, 'auto_focus' => 'autofocus'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 165, 'height' => 160
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Modifier',
                                       'title' => 'Mettre à jour ce témoignage'
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