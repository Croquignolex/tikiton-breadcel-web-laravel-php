@inject('orderService', 'App\Services\OrderService')
@extends('layouts.mail')

@section('title', page_title(trans('general.order')))

@section('head', mb_strtoupper(trans('general.your_order')))

@section('body')
    @component('components.user-mail-order-table', [
        'order' => $order,
        'orderService' => $orderService
        ])
        <p style="text-align: justify;">
            <strong style="color: {{ $order->format_status->hexadecimal_color }}">
                {{ mb_strtoupper($order->format_status->label) }}
            </strong>
            <br />
            <strong>
                @lang('mail.top_sold_order_msg', ['name' => $order->user->format_first_name]).
            </strong>
        </p>
        <p style="text-align: justify;">
            @lang('mail.body_sold_order_msg' , ['date' => $order->user->updated_date .
                ' ' . trans('general.at') .
                ' ' . $order->user->updated_time
            ]).
        </p>
    @endcomponent
@endsection
