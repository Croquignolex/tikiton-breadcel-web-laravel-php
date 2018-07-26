@extends('admin.layouts.admin')

@section('home.title', page_title($testimonial->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
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
                        @component('admin.components.update-button', [
                            'route' => route('admin.testimonials.edit', [$testimonial]),
                            'title' => 'Modifier ce témoignage'
                            ])
                        @endcomponent
                        @component('admin.components.delete-button', [
                            'target' => 'delete-testimonial',
                            'title' => 'Supprimer ce témoignage'
                            ])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-5 grid-margin stretch-card align-items-start">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $testimonial->image_path }}" alt="..." class="img-fluid">
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body row text-secondary">
                    <div class="col-sm-5 side-bar-item">NOM</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $testimonial->format_name }}</div>
                    <div class="col-sm-5 side-bar-item">DESCRIPTION (fr)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                        {{ $testimonial->fr_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">DESCRIPTION (en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $testimonial->en_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $testimonial->created_date }} à {{ $testimonial->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $testimonial->updated_date }} à {{ $testimonial->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @component('components.modal', [
        'title' => 'Supprimer le témoignage',
        'id' => 'delete-testimonial', 'color' => 'danger',
        'action_route' => route('admin.testimonials.destroy', [$testimonial])
        ])
        Etes-vous sûr de vouloir supprimer le témoignage de {{ $testimonial->format_name }}?
    @endcomponent
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush