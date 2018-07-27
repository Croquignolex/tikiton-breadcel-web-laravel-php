@extends('admin.layouts.admin')

@section('home.title', page_title($team->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($team->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.teams.index'),
                            'label' => 'Liste des membres'
                            ])
                        @endcomponent
                        @component('admin.components.update-button', [
                            'route' => route('admin.teams.edit', [$team]),
                            'title' => 'Modifier ce membre'
                            ])
                        @endcomponent
                        @component('admin.components.delete-button', [
                            'target' => 'delete-team',
                            'title' => 'Supprimer ce membre'
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
                    <img src="{{ $team->image_path }}" alt="..." class="img-fluid">
                </div>
            </div>
        </div>
        <!-- Content table End -->
        <!-- Content table Start -->
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body row text-secondary">
                    <div class="col-sm-5 side-bar-item">NOM</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->format_name }}</div>
                    <div class="col-sm-5 side-bar-item">FONTION (fr)</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->fr_function }}</div>
                    <div class="col-sm-5 side-bar-item">FONTION (en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->en_function }}</div>
                    <div class="col-sm-5 side-bar-item">FACEBOOK</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->facebook }}</div>
                    <div class="col-sm-5 side-bar-item">TWITTER</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->twitter }}</div>
                    <div class="col-sm-5 side-bar-item">LINKEDIN</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->linkedin }}</div>
                    <div class="col-sm-5 side-bar-item">GOOGLEPLUS</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->googleplus }}</div>
                    <div class="col-sm-5 side-bar-item">DESCRIPTION (fr)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                        {{ $team->fr_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">DESCRIPTION (en)</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $team->en_description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->created_date }} à {{ $team->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $team->updated_date }} à {{ $team->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @component('components.modal', [
        'title' => 'Supprimer le membre',
        'id' => 'delete-team', 'color' => 'danger',
        'action_route' => route('admin.teams.destroy', [$team])
        ])
        Etes-vous sûr de vouloir supprimer le membre {{ text_format($team->format_name, 50) }}?
    @endcomponent
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush