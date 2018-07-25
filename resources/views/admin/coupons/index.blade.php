@extends('admin.layouts.admin')

@section('home.title', page_title('Coupons'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('barcode') }}"></i>
                        COUPONS
                        <a href="{{ route('admin.coupons.create') }}"
                           class="btn btn-secondary">
                            <i class="{{ font('plus') }}"></i>
                            Ajouter
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ mb_strtoupper($table_label) }} ({{ $paginationTools->displayItems->count() }} sur {{ $paginationTools->itemsNumber }})</h4>
                    @component('components.pagination',
                        ['paginationTools' => $paginationTools])
                    @endcomponent
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="table-secondary">
                                    <th>CODE</th>
                                    <th>REDUCTION</th>
                                    <th>DESCRIPTION</th>
                                    <th>CLIENTS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paginationTools->displayItems as $coupon)
                                    <tr>
                                        <td>{{ $coupon->code }}</td>
                                        <td class="text-right">{{ money_currency($coupon->promo) }}</td>
                                        <td>{{ text_format($coupon->description, 30) }}</td>
                                        <td class="text-right">{{ $coupon->users->count() }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-warning btn-icons btn-rounded" title="Modifier le coupon"
                                                href="{{ route('admin.coupons.edit', [$coupon]) }}">
                                                <i class="{{ font('pencil') }}"></i>
                                            </a>
                                            <a class="btn btn-secondary btn-icons btn-rounded" title="Voir les détails"
                                               href="{{ route('admin.coupons.show', [$coupon]) }}">
                                                <i class="{{ font('eye') }}"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-icons btn-rounded" title="Supprimer ce coupon"
                                                data-toggle="modal" data-target="#delete-coupon-{{ $coupon->id }}">
                                                <i class="{{ font('trash-o') }}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-info text-center">
                                                Pas de {{ mb_strtolower($table_label) }} pour le momment
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $coupon)
        @component('components.modal', [
            'title' => 'Supprimer le coupon',
            'id' => 'delete-coupon-' . $coupon->id, 'color' => 'danger',
            'action_route' => route('admin.coupons.destroy', [$coupon])
            ])
            Etes-vous sûr de vouloir supprimer {{ $coupon->code }}?
        @endcomponent
    @endforeach
@endsection
