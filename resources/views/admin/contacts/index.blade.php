@extends('admin.layouts.admin')

@section('home.title', page_title('Méssages'))

@section('home.body')
    <div class="row">
        <!-- Filter Buttons Start -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-theme">
                        <i class="menu-icon {{ font('envelope') }}"></i>
                        MESSAGES
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
                'headers' => ['nom', 'email', 'téléphone', 'sujet', 'méssage']
                ])
                @forelse($paginationTools->displayItems as $contact)
                    <tr class="{{ $contact->is_read ? '' : 'text-secondary' }}">
                        <td>{{ text_format($contact->format_name, 15) }}</td>
                        <td>{{ text_format($contact->email, 15) }}</td>
                        <td>{{ text_format($contact->phone, 15) }}</td>
                        <td>{{ text_format($contact->subject, 15) }}</td>
                        <td>{{ text_format($contact->message, 20) }}</td>
                        <td class="text-right">
                            @component('admin.components.details-button',
                                ['route' => route('admin.contacts.show', [$contact])])
                            @endcomponent
                            @component('admin.components.delete-button', [
                                'target' => 'delete-contact-' . $contact->id,
                                'title' => 'Supprimer ce méssage',
                                'label' => '', 'class' => 'btn btn-danger btn-icons btn-rounded'
                                ])
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @component('admin.components.empty_table_alert',
                     ['size' => 6, 'table_label' => $table_label])
                    @endcomponent
                @endforelse
            @endcomponent
        </div>
        <!-- Content table End -->
    </div>

    @foreach($paginationTools->displayItems as $contact)
        @component('components.modal', [
            'title' => 'Supprimer le message',
            'id' => 'delete-contact-' . $contact->id, 'color' => 'danger',
            'action_route' => route('admin.contacts.destroy', [$contact])
            ])
            Etes-vous sûr de vouloir supprimer le méssage de {{ text_format($contact->format_name, 50) }}?
        @endcomponent
    @endforeach
@endsection
