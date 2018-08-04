@extends('admin.layouts.admin')

@section('home.title', page_title($coupon->code))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        METTRE A JOUR
                        <strong class="text-theme">
                            {{ mb_strtoupper($coupon->code) }}
                        </strong>
                    </h4>
                    <div>
                        @component('admin.components.back-button', [
                            'route' => route('admin.coupons.index'),
                            'label' => 'Liste des coupons'
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
                    <form class="forms-sample" method="POST" action="{{ route('admin.coupons.update', [$coupon]) }}"
                          @submit="validateFormElements">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'discount', 'label' => 'discount'
                                       ])
                                        @component('components.input', [
                                            'type' => 'text', 'name' => 'discount', 'class' => 'form-control',
                                             'value' => old('discount') ?? $coupon->discount, 'minlength' => 1
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.label-input', [
                                       'name' => 'customers', 'label' => 'customers'
                                       ])
                                        @component('components.multi-select', [
                                            'name' => 'customers', 'class' => 'form-control', 'title' => 'Sélectionner les clients',
                                             'values' => old('customers') ?? $tabTCustomerIds, 'options' => $customers
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @component('components.label-input', [
                                        'name' => 'description', 'label' => 'description'
                                        ])
                                        @component('components.textarea', [
                                            'name' => 'description', 'class' => 'form-control',
                                            'value' => old('description') ?? $coupon->description
                                            ])
                                        @endcomponent
                                    @endcomponent
                                </div>
                                <div class="form-group">
                                    @component('components.submit', [
                                       'class' => 'btn btn-secondary', 'value' => 'Modifier',
                                       'title' => 'Mettre à jour ce coupon'
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