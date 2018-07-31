@extends('admin.layouts.admin')

@section('home.title', page_title($user->format_first_name))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <strong class="text-theme">
                            {{ mb_strtoupper($user->format_full_name) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.profile.index'),
                            'label' => 'Mon profil'
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.profile.update') }}"
                          @submit="validateFormElements">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'first_name', 'label' => 'first_name'
                                        ])
                                        @component('components.input', [
                                            'auto_focus' => 'autofocus', 'class' => 'form-control',
                                            'type' => 'text', 'name' => 'first_name',
                                             'value' => old('first_name') ?? $user->first_name
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'last_name', 'label' => 'last_name',
                                        ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'last_name', 'class' => 'form-control',
                                             'value' => old('last_name') ?? $user->last_name
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'phone', 'label' => 'phone', 'no_star' => ''
                                        ])
                                        @component('components.input', [
                                            'type' => 'text','name' => 'phone', 'class' => 'form-control',
                                            'value' => old('phone') ?? $user->phone, 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                         'name' => 'company', 'label' => 'company',
                                         'no_star' => ''
                                         ])
                                        @component('components.input', [
                                            'value' => old('company') ?? $user->company, 'class' => 'form-control',
                                            'type' => 'text','name' => 'company', 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                      'name' => 'country', 'label' => 'country', 'no_star' => ''
                                      ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'country', 'class' => 'form-control',
                                            'value' => old('country') ?? $user->country, 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'city', 'label' => 'city', 'no_star' => ''
                                        ])
                                        @component('components.input', [
                                            'type' => 'text','name' => 'city', 'class' => 'form-control',
                                            'value' => old('city') ?? $user->city, 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'address', 'label' => 'address', 'no_star' => ''
                                        ])
                                        @component('components.input', [
                                            'type' => 'text','name' => 'address', 'class' => 'form-control',
                                            'value' => old('address') ?? $user->address, 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'post_code', 'label' => 'post_code', 'no_star' => ''
                                        ])
                                        @component('components.input', [
                                            'type' => 'text','name' => 'post_code', 'class' => 'form-control',
                                            'value' => old('post_code') ?? $user->post_code, 'validate' => 'false'
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Modifier',
                                       'title' => 'Mettre à jour mon profil'
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