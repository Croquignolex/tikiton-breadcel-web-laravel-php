@inject('orderService', 'App\Services\OrderService')
@extends('layouts.mail')

@section('title', 'Nouvelle commande')

@section('head', mb_strtoupper('Nouvelle commande'))

@section('body')
    <tr>
        <td>
            <p style="text-align: justify;">
                <strong>
                    Un client viens de passer une nouvelle commande
                    le {{ $order->fr_updated_date }} à {{ $order->fr_updated_time }}.
                    Voici les détails de cette commande:
                </strong>
            </p>
            @component('components.mail-order-table', [
                'order' => $order,
                'orderService' => $orderService
                ])
            @endcomponent
            <div style="text-align: center;">
                <a href="#" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #da7612; text-decoration:none;" target="_blank">
                    Valider la commande
                </a>
            </div>
            <p style="text-align: justify;">
                Si ce bouton ne fonctionne pas, essayez de copier et coller
                cet URL dans votre navigateur web # Si le problème perssiste,
                s'il vous plais sentez vous libre de contacter l'équipe
                de developpement.
            </p>
        </td>
    </tr>
@endsection
