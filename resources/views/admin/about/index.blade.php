@extends('admin.layouts.admin')

@section('home.title', page_title('A propos'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('info-circle') }}"></i>
                        A propos de nous
                    </h4>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                   Bienvenue sur Bread'Cel
                                </div>
                                <div class="card-body bg-light">
                                    <div class="text-center text-primary">
                                        SECTION
                                    </div>
                                    <form action="{{ route('admin.about.welcome.section') }}"
                                        method="POST" @submit="validateFormElements">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'fr_about_section_1_normal_zone', 'label' => 'FR'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'fr_about_section_1_normal_zone', 'class' => 'form-control',
                                                    'value' => old('fr_about_section_1_normal_zone') ?? $about->fr_about_section_1_normal_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'en_about_section_1_normal_zone', 'label' => 'EN'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'en_about_section_1_normal_zone', 'class' => 'form-control',
                                                    'value' => old('en_about_section_1_normal_zone') ?? $about->en_about_section_1_normal_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.submit', [
                                               'class' => 'btn btn-primary', 'value' => 'Appliquer',
                                               'title' => 'Mettre à jour la section Bienvenue sur Bread\'Cel'
                                               ])
                                            @endcomponent
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center text-primary">
                                        COMMANTAIRE
                                    </div>
                                    <form action="{{ route('admin.about.welcome.comment') }}"
                                          method="POST" @submit="validateFormElements">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'fr_about_section_1_important_zone', 'label' => 'FR'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'fr_about_section_1_important_zone', 'class' => 'form-control',
                                                    'value' => old('fr_about_section_1_important_zone') ?? $about->fr_about_section_1_important_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'en_about_section_1_important_zone', 'label' => 'EN'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'en_about_section_1_important_zone', 'class' => 'form-control',
                                                    'value' => old('en_about_section_1_important_zone') ?? $about->en_about_section_1_important_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.submit', [
                                               'class' => 'btn btn-primary', 'value' => 'Appliquer',
                                               'title' => 'Mettre à jour le commentaire Bienvenue sur Bread\'Cel'
                                               ])
                                            @endcomponent
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    Pourquoi nous choisir
                                </div>
                                <div class="card-body bg-light">
                                    <div class="text-center text-info">
                                        SECTION
                                    </div>
                                    <form action="{{ route('admin.about.why.section') }}"
                                          method="POST" @submit="validateFormElements">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'fr_about_section_2_normal_zone', 'label' => 'FR'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'fr_about_section_2_normal_zone', 'class' => 'form-control',
                                                    'value' => old('fr_about_section_2_normal_zone') ?? $about->fr_about_section_2_normal_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'en_about_section_2_normal_zone', 'label' => 'EN'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'en_about_section_2_normal_zone', 'class' => 'form-control',
                                                    'value' => old('en_about_section_2_normal_zone') ?? $about->en_about_section_2_normal_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.submit', [
                                               'class' => 'btn btn-info', 'value' => 'Appliquer',
                                               'title' => 'Mettre à jour la section Pouquoi nous choisir'
                                               ])
                                            @endcomponent
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center text-info">
                                        COMMENTRAIRE
                                    </div>
                                    <form action="{{ route('admin.about.why.comment') }}"
                                          method="POST" @submit="validateFormElements">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'fr_about_section_2_important_zone', 'label' => 'FR'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'fr_about_section_2_important_zone', 'class' => 'form-control',
                                                    'value' => old('fr_about_section_2_important_zone') ?? $about->fr_about_section_2_important_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.label-input', [
                                               'name' => 'en_about_section_2_important_zone', 'label' => 'EN'
                                               ])
                                                @component('components.textarea', [
                                                    'name' => 'en_about_section_2_important_zone', 'class' => 'form-control',
                                                    'value' => old('en_about_section_2_important_zone') ?? $about->en_about_section_2_important_zone
                                                    ])
                                                @endcomponent
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.submit', [
                                               'class' => 'btn btn-info', 'value' => 'Appliquer',
                                               'title' => 'Mettre à jour le commentaire Pouquoi nous choisir'
                                               ])
                                            @endcomponent
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center text-info">
                                        ILLUSTRATION
                                    </div>
                                    <div class="about-image">
                                        <img src="{{ $about->image_path }}" alt="..." class="img-fluid">
                                    </div>
                                    <form action="{{ route('admin.about.why.image') }}" method="POST"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            @component('admin.components.image-upload', [
                                               'width' => 570, 'height' => 330
                                               ])
                                            @endcomponent
                                        </div>
                                        <div class="form-group">
                                            @component('components.submit', [
                                               'class' => 'btn btn-info', 'value' => 'Appliquer',
                                               'title' => 'Mettre à jour l\'illustration'
                                               ])
                                            @endcomponent
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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