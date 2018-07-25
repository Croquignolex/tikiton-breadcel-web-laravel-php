@extends('admin.layouts.admin')

@section('home.title', page_title($coupon->code))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        DETAIL DE
                        <strong class="text-theme">
                            {{ mb_strtoupper($coupon->code) }}
                        </strong>
                    </h4>
                    <div>
                        <a href="{{ route('admin.coupons.index') }}"
                           class="btn btn-theme">
                            <i class="{{ font('arrow-left') }}"></i>
                            Liste des coupons
                        </a>
                        <a class="btn btn-warning" title="Modifier ce coupon"
                           href="{{ route('admin.coupons.edit', [$coupon]) }}">
                            <i class="{{ font('pencil') }}"></i>
                            Modifier
                        </a>
                        <button type="button" class="btn btn-danger" title="Supprimer ce coupon"
                                data-toggle="modal" data-target="#delete-coupon">
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
                    <div class="col-lg-5 side-bar-item">CODE</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ $coupon->code }}</div>
                    <div class="col-lg-5 side-bar-item">REDUCTION</div>
                    <div class="col-lg-7 text-dark side-bar-item">{{ money_currency($coupon->promo) }}</div>
                    <div class="col-lg-5 side-bar-item">Description</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $coupon->description }}
                        </p>
                    </div>
                    <div class="col-lg-5 side-bar-item">Clients ({{ $coupon->users->count() }})</div>
                    <div class="col-lg-7 text-dark side-bar-item">
                        <p>
                            @forelse($coupon->users as $user)
                                <a href="{{ route('admin.customers.show', [$user]) }}"
                                   title="{{ $user->pivot->is_activated ? 'Peut utiliser ce coupon' : 'Ne peut plus utiliser ce coupon'}}">
                                    <label class="badge badge-danger">
                                        <i class="{{ font('barcode') }}"></i>
                                        {{ $user->format_full_name }}
                                    </label>
                                </a>
                            @empty
                                <strong class="text-danger">
                                    Ce coupon n'a pas encore été affecté à un client
                                </strong>
                            @endforelse
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @component('components.modal', [
        'title' => 'Supprimer le coupon',
        'id' => 'delete-coupon', 'color' => 'danger',
        'action_route' => route('admin.coupons.destroy', [$coupon])
        ])
        Etes-vous sûr de vouloir supprimer {{ $coupon->code }}?
    @endcomponent
@endsection

@push('admin.script.page')
    <!-- Page scripts -->
    <script src="{{ js_asset('bootstrap-maxlength') }}" type="text/javascript"></script>
    <script src="{{ js_asset('form-validator') }}" type="text/javascript"></script>
    <script src="{{ js_asset('min-max-4') }}" type="text/javascript"></script>
@endpush