@inject('orderService', 'App\Services\OrderService')
@extends('layouts.mail')

@section('title', 'Commande annulé')

@section('head', mb_strtoupper('Commande annulé'))

@section('body')
    <tr>
        <td>
            <p style="text-align: justify;">
                <strong>
                    Un client viens d'annuler une commande
                    le {{ $order->fr_updated_date }} à {{ $order->fr_updated_time }}.
                    Voici les détails de cette commande:
                </strong>
            </p>
            @component('components.mail-order-table', [
                'order' => $order,
                'orderService' => $orderService
                ])
            @endcomponent
            <p style="text-align: justify;">
                Si ce bouton ne fonctionne pas, essayez de copier et coller
                cet URL dans votre navigateur web. Si le problème perssiste,
                s'il vous plais sentez vous libre de contacter l'équipe
                de developpement.
            </p>
        </td>
    </tr>
@endsection
