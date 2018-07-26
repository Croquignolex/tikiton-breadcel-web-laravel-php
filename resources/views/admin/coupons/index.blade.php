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
                        @component('admin.components.add-button',
                           ['route' => route('admin.coupons.create')])
                        @endcomponent
                    </h4>
                </div>
            </div>
        </div>
        <!-- Filter Buttons End -->
        <!-- Content table Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            @component('admin.components.table-card', [
                'table_label' => $table_label,
                'paginationTools' => $paginationTools,
                'headers' => ['code', 'réduction', 'description', 'clients']
                ])
                @forelse($paginationTools->displayItems as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td class="text-right">{{ money_currency($coupon->promo) }}</td>
                        <td>{{ text_format($coupon->description, 30) }}</td>
                        <td class="text-right">{{ $coupon->users->count() }}</td>
                        <td class="text-right">
                            @component('admin.components.update-button', [
                                'route' => route('admin.coupons.edit', [$coupon]),
                                'title' => 'Modifier ce coupon',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                               ['route' => route('admin.coupons.show', [$coupon])])
                            @endcomponent
                            @component('admin.components.delete-button', [
                               'target' => 'delete-coupon-' . $coupon->id,
                               'title' => 'Supprimer ce coupon',
                               'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                               ])
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 5, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
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
