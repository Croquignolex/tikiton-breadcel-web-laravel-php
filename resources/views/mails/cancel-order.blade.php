@inject('orderService', 'App\Services\OrderService')
@extends('layouts.mail')

@section('title', 'Commande annulé')

@section('head', mb_strtoupper('Commande annulé'))

@section('body')
    @component('components.mail-order-table', [
        'order' => $order,
        'orderService' => $orderService
        ])
        <p style="text-align: justify;">
            <strong>
                Un client viens d'annuler une commande
                le {{ $order->fr_updated_date }} à {{ $order->fr_updated_time }}.
                Voici les détails de cette commande:
            </strong>
        </p>
    @endcomponent
@endsection
