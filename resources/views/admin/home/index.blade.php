@extends('admin.layouts.admin')

@section('home.title', page_title('Accueil'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('home') }}"></i>
                        Accueil
                    </h4>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-4 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Bannière 1
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.banner.1') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_banner_1_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_banner_1_text_1', 'class' => 'form-control',
                                             'value' => old('fr_banner_1_text_1') ?? $home->fr_banner_1_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_banner_1_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_banner_1_text_1', 'class' => 'form-control',
                                             'value' => old('en_banner_1_text_1') ?? $home->en_banner_1_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_banner_1_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_banner_1_text_2', 'class' => 'form-control',
                                             'value' => old('fr_banner_1_text_2') ?? $home->fr_banner_1_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_banner_1_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_banner_1_text_2', 'class' => 'form-control',
                                             'value' => old('en_banner_1_text_2') ?? $home->en_banner_1_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->banner1_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 1600, 'height' => 750, 'name' => 'banner_1'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-primary', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour la bannière 1'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-4 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Bannière 2
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.banner.2') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_banner_2_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_banner_2_text_1', 'class' => 'form-control',
                                             'value' => old('fr_banner_2_text_1') ?? $home->fr_banner_2_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_banner_2_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_banner_2_text_1', 'class' => 'form-control',
                                             'value' => old('en_banner_2_text_1') ?? $home->en_banner_2_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_banner_2_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_banner_2_text_2', 'class' => 'form-control',
                                             'value' => old('fr_banner_2_text_2') ?? $home->fr_banner_2_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_banner_2_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_banner_2_text_2', 'class' => 'form-control',
                                             'value' => old('en_banner_2_text_2') ?? $home->en_banner_2_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->banner2_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 1600, 'height' => 750, 'name' => 'banner_2'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-primary', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour la bannière 2'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-4 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Bannière 3
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.banner.3') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_banner_3_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_banner_3_text_1', 'class' => 'form-control',
                                             'value' => old('fr_banner_3_text_1') ?? $home->fr_banner_3_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_banner_3_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_banner_3_text_1', 'class' => 'form-control',
                                             'value' => old('en_banner_3_text_1') ?? $home->en_banner_3_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_banner_3_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_banner_3_text_2', 'class' => 'form-control',
                                             'value' => old('fr_banner_3_text_2') ?? $home->fr_banner_3_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_banner_3_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_banner_3_text_2', 'class' => 'form-control',
                                             'value' => old('en_banner_3_text_2') ?? $home->en_banner_3_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->banner3_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 1600, 'height' => 750, 'name' => 'banner_3'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-primary', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour la bannière 3'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-6 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Offre 1
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.offer.1') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_1_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_1_text_1', 'class' => 'form-control',
                                             'value' => old('fr_offer_1_text_1') ?? $home->fr_offer_1_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_1_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_1_text_1', 'class' => 'form-control',
                                             'value' => old('en_offer_1_text_1') ?? $home->en_offer_1_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_1_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_1_text_2', 'class' => 'form-control',
                                             'value' => old('fr_offer_1_text_2') ?? $home->fr_offer_1_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_1_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_1_text_2', 'class' => 'form-control',
                                             'value' => old('en_offer_1_text_2') ?? $home->en_offer_1_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->offer1_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 675, 'height' => 420, 'name' => 'offer_1'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-info', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour l\'offre 1'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-6 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Offre 2
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.offer.2') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_2_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_2_text_1', 'class' => 'form-control',
                                             'value' => old('fr_offer_2_text_1') ?? $home->fr_offer_2_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_2_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_2_text_1', 'class' => 'form-control',
                                             'value' => old('en_offer_2_text_1') ?? $home->en_offer_2_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_2_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_2_text_2', 'class' => 'form-control',
                                             'value' => old('fr_offer_2_text_2') ?? $home->fr_offer_2_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_2_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_2_text_2', 'class' => 'form-control',
                                             'value' => old('en_offer_2_text_2') ?? $home->en_offer_2_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->offer2_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 450, 'height' => 420, 'name' => 'offer_2'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-info', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour l\'offre 2'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-6 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Offre 3
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.offer.3') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_3_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_3_text_1', 'class' => 'form-control',
                                             'value' => old('fr_offer_3_text_1') ?? $home->fr_offer_3_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_3_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_3_text_1', 'class' => 'form-control',
                                             'value' => old('en_offer_3_text_1') ?? $home->en_offer_3_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_3_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_3_text_2', 'class' => 'form-control',
                                             'value' => old('fr_offer_3_text_2') ?? $home->fr_offer_3_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_3_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_3_text_2', 'class' => 'form-control',
                                             'value' => old('en_offer_3_text_2') ?? $home->en_offer_3_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->offer3_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 675, 'height' => 420, 'name' => 'offer_3'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-info', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour l\'offre 3'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-6 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Offre 4
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.offer.4') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_4_text_1', 'label' => 'fr_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_4_text_1', 'class' => 'form-control',
                                             'value' => old('fr_offer_4_text_1') ?? $home->fr_offer_4_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_4_text_1', 'label' => 'en_text_1'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_4_text_1', 'class' => 'form-control',
                                             'value' => old('en_offer_4_text_1') ?? $home->en_offer_4_text_1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_offer_4_text_2', 'label' => 'fr_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_offer_4_text_2', 'class' => 'form-control',
                                             'value' => old('fr_offer_4_text_2') ?? $home->fr_offer_4_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_offer_4_text_2', 'label' => 'en_text_2'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_offer_4_text_2', 'class' => 'form-control',
                                             'value' => old('en_offer_4_text_2') ?? $home->en_offer_4_text_2
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->offer4_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 1600, 'height' => 750, 'name' => 'offer_4'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-info', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour l\'offre 4'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-theme text-white">
                            Présentation
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('admin.home.magic') }}" enctype="multipart/form-data"
                                  method="POST" @submit="validateFormElements">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_magic_header', 'label' => 'fr_magic_header'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_magic_header', 'class' => 'form-control',
                                             'value' => old('fr_magic_header') ?? $home->fr_magic_header
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_magic_header', 'label' => 'en_magic_header'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_magic_header', 'class' => 'form-control',
                                             'value' => old('en_magic_header') ?? $home->en_magic_header
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_magic_title', 'label' => 'fr_magic_title'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'fr_magic_title', 'class' => 'form-control',
                                             'value' => old('fr_magic_title') ?? $home->fr_magic_title
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_magic_title', 'label' => 'en_magic_title'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'en_magic_title', 'class' => 'form-control',
                                             'value' => old('en_magic_title') ?? $home->en_magic_title
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'fr_magic_description', 'label' => 'fr_magic_description'
                                       ])
                                        @component('components.textarea', [
                                            'name' => 'fr_magic_description', 'class' => 'form-control',
                                            'value' => old('fr_magic_description') ?? $home->fr_magic_description
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'en_magic_description', 'label' => 'en_magic_description'
                                       ])
                                        @component('components.textarea', [
                                            'name' => 'en_magic_description', 'class' => 'form-control',
                                            'value' => old('en_magic_description') ?? $home->en_magic_description
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="about-image text-center">
                                    <img src="{{ $home->magic_image_path }}" alt="..." class="img-fluid">
                                </div>
                                <div class="form-group">
                                    @component('admin.components.image-upload', [
                                       'width' => 790, 'height' => 300, 'name' => 'magic'
                                       ])
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-theme', 'value' => 'Appliquer',
                                       'title' => 'Mettre à jour la présentation'
                                       ])
                                    @endcomponent
                                </div>
                            </form>
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