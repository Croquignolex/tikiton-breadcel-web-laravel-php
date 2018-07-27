@extends('admin.layouts.admin')

@section('home.title', page_title($contact->format_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($contact->format_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.contacts.index'),
                            'label' => 'Liste des méssages'
                            ])
                        @endcomponent
                        @component('admin.components.delete-button', [
                            'target' => 'delete-contact',
                            'title' => 'Supprimer ce méssages'
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
                <div class="card-body row text-secondary">
                    <div class="col-sm-5 side-bar-item">NOM</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $contact->format_name }}</div>
                    <div class="col-sm-5 side-bar-item">EMAIL</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $contact->email }}</div>
                    <div class="col-sm-5 side-bar-item">TELEPHONE</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $contact->phone }}</div>
                    <div class="col-sm-5 side-bar-item">SUJET</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $contact->subject }}</div>
                    <div class="col-sm-5 side-bar-item">MESSAGE</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $contact->message }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $contact->created_date }} à {{ $contact->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $contact->updated_date }} à {{ $contact->updated_time }}</div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @component('components.modal', [
        'title' => 'Supprimer le méssage',
        'id' => 'delete-contact', 'color' => 'danger',
        'action_route' => route('admin.contacts.destroy', [$contact])
        ])
        Etes-vous sûr de vouloir supprimer le méssage de {{ text_format($contact->format_name, 50) }}?
    @endcomponent
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush