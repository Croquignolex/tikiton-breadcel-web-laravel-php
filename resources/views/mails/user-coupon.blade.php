@extends('layouts.mail')

@section('title', page_title(trans('general.coupon_code')))

@section('head', mb_strtoupper(trans('general.your_coupon')))

@section('body')
    <tr>
        <td>
            <p style="text-align: justify;">
                <strong style="color: #da7612">
                    {{ mb_strtoupper($coupon->code) }}
                </strong>
                <br />
                <strong>
                    @lang('mail.top_coupon_msg', ['name' => $user->format_first_name]).
                </strong>
            </p>
            <p style="text-align: justify;">
                @lang('mail.body_coupon_msg', ['discount' => money_currency($coupon->promo)]).
            </p>
            <div style="text-align: center;">
                <a href="{{ locale_route('products.index') }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #da7612; text-decoration:none;" target="_blank">
                    @lang('mail.shop_now')
                </a>
            </div>
            <p style="text-align: justify;">
                @lang('mail.bottom_register_msg', [
                    'contact' => config('company.email_1')
                ]).
            </p>
        </td>
    </tr>
@endsection
