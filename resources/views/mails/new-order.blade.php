@inject('orderService', 'App\Services\OrderService')
@extends('layouts.mail')

@section('title', 'Nouvelle commande')

@section('head', mb_strtoupper('Nouvelle commande'))

@section('body')
    @component('components.mail-order-table', [
        'order' => $order,
        'orderService' => $orderService
        ])
        <p style="text-align: justify;">
            <strong>
                Un client viens de passer une nouvelle commande
                le {{ $order->fr_updated_date }} à {{ $order->fr_updated_time }}.
                Voici les détails de cette commande:
            </strong>
        </p>
    @endcomponent
@endsection
