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
            <p style="text-align: justify;">
                <strong>Nom & Prénom:</strong> {{ $order->user->first_name }} {{ $order->user->last_name }}<br />
                <strong>Email:</strong> {{ $order->user->email }}<br />
                <strong>Tel:</strong> {{ $order->user->phone }}<br />
                <strong>Commande N°:</strong> {{ $order->reference }}
            </p>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td align="right"><strong>Prix unitaire</strong></td>
                    <td align="right"><strong>Quantité</strong></td>
                    <td align="right"><strong>Total</strong></td>
                </tr>
                @foreach($order->products as $product)
                    <tr>
                        <td style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;">{{ $product->fr_name }}</td>
                        <td style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right">
                            @if($product->is_a_discount)
                                <i style="text-decoration: line-through;">{{ money_currency($product->fr_amount) }}</i>
                                {{ money_currency($product->fr_new_price) }}
                            @else
                                {{ money_currency($product->fr_amount) }}
                            @endif
                        </td>
                        <td style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right">{{ $product->pivot->quantity }}</td>
                        <td style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right">
                            @if($product->is_a_discount)
                                <i style="text-decoration: line-through;">{{ money_currency($product->fr_cart_line_value) }}</i>
                                {{ money_currency($product->fr_cart_discount_line_value) }}
                            @else
                                {{ money_currency($product->fr_cart_line_value) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;"><strong>Sous total</strong></td>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right"><strong>{{ money_currency($orderService->getSubTotal($order)) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;"><strong>TVA ({{ $orderService->getTVAPercentage() }})</strong></td>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right"><strong>{{ money_currency($orderService->getTVA($order)) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;"><strong>Coupon</strong></td>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right"><strong>- {{ money_currency($order->discount) }}</strong></td>
                </tr>
                <tr style="color: #DA7612; font-size: 18px;">
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 10px 0;"><strong>Grand total</strong></td>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 10px 0;" align="right"><strong>{{ money_currency($orderService->getBigTotal($order)) }}</strong></td>
                </tr>
                </tbody>
            </table>
            <p style="text-align: justify;">
                Si ce bouton ne fonctionne pas, essayez de copier et coller
                cet URL dans votre navigateur web # Si le problème perssiste,
                s'il vous plais sentez vous libre de contacter l'équipe
                de developpement.
            </p>
        </td>
    </tr>
@endsection
