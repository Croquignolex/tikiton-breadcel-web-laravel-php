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
                        @component('admin.components.back-button', [
                            'route' => route('admin.coupons.index'),
                            'label' => 'Liste des coupons'
                            ])
                        @endcomponent
                        @component('admin.components.update-button', [
                            'route' => route('admin.coupons.edit', [$coupon]),
                            'title' => 'Modifier ce coupon'
                            ])
                        @endcomponent
                        @component('admin.components.delete-button', [
                            'target' => 'delete-coupon',
                            'title' => 'Supprimer ce coupon'
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
                    <div class="col-sm-5 side-bar-item">CODE</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $coupon->code }}</div>
                    <div class="col-sm-5 side-bar-item">REDUCTION</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ money_currency($coupon->promo) }}</div>
                    <div class="col-sm-5 side-bar-item">Description</div>
                    <div class="col-sm-7 text-dark side-bar-item">
                        <p class="multi-line-text">
                            {{ $coupon->description }}
                        </p>
                    </div>
                    <div class="col-sm-5 side-bar-item">Clients ({{ $coupon->users->count() }})</div>
                    <div class="col-sm-7 text-dark side-bar-item">
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
                    <div class="col-sm-5 side-bar-item">Création</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $coupon->created_date }} à {{ $coupon->created_time }}</div>
                    <div class="col-sm-5 side-bar-item">Dernière modifcation</div>
                    <div class="col-sm-7 text-dark side-bar-item">{{ $coupon->updated_date }} à {{ $coupon->updated_time }}</div>
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