@extends('admin.layouts.admin')

@section('home.title', page_title('Témoignages'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('globe') }}"></i>
                        TEMOIGNAGES
                        @component('admin.components.add-button',
                           ['route' => route('admin.testimonials.create')])
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
                'headers' => ['nom', 'description (fr)', 'description (en)']
                ])
                @forelse($paginationTools->displayItems as $testimonial)
                    <tr>
                        <td>{{ $testimonial->format_name }}</td>
                        <td>{{ text_format($testimonial->fr_description, 30) }}</td>
                        <td>{{ text_format($testimonial->en_description, 30) }}</td>
                        <td class="text-right">
                            @component('admin.components.update-button', [
                                'route' => route('admin.testimonials.edit', [$testimonial]),
                                'title' => 'Modifier ce témoignage',
                                'label' => '', 'class' => 'btn btn-warning btn-icons btn-rounded'
                                ])
                            @endcomponent
                            @component('admin.components.details-button',
                               ['route' => route('admin.testimonials.show', [$testimonial])])
                            @endcomponent
                            @component('admin.components.delete-button', [
                               'target' => 'delete-testimonial-' . $testimonial->id,
                               'title' => 'Supprimer ce témoignage',
                               'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                               ])
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 4, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $testimonial)
        @component('components.modal', [
            'title' => 'Supprimer le témoignage',
            'id' => 'delete-testimonial-' . $testimonial->id, 'color' => 'danger',
            'action_route' => route('admin.testimonials.destroy', [$testimonial])
            ])
            Etes-vous sûr de vouloir supprimer le témoignage de {{ $testimonial->format_name }}?
        @endcomponent
    @endforeach
@endsection
