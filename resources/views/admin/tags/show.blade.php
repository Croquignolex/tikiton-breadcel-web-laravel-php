@extends('admin.layouts.admin')

@section('home.title', page_title($tag->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($tag->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        <a href="{{ route('admin.tags.index') }}"
                           class="btn btn-theme">
                            <i class="{{ font('arrow-left') }}"></i>
                            Liste des étiquettes
                        </a>
                        <a class="btn btn-warning" title="Modifier cette étiquette"
                           href="{{ route('admin.tags.edit', [$tag]) }}">
                            <i class="{{ font('pencil') }}"></i>
                            Modifier
                        </a>
                        <button type="button" class="btn btn-danger" title="Supprimer cette étiquette"
                                data-toggle="modal" data-target="#delete-tag">
                            <i class="{{ font('trash-o') }}"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body row text-secondary">
                    <div class="col-lg-5 side-bar-item">NOM(fr)</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $tag->fr_name }}</div>
                    <div class="col-lg-5 side-bar-item">NOM(en)</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $tag->en_name }}</div>
                    <div class="col-lg-5 side-bar-item">Description(fr)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $tag->fr_description }}
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Description(en)</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $tag->en_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @component('components.modal', [
        'title' => 'Supprimer l\'étiquette',
        'id' => 'delete-tag', 'color' => 'danger',
        'action_route' => route('admin.tags.destroy', [$tag])
        ])
        Etes-vous sûr de vouloir supprimer {{ $tag->format_name }}?
    @endcomponent
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush