<tr>
    <td>
        {{ $slot }}
        <table width="100%" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td><strong>@lang('general.name')</strong></td>
                    <td align="right"><strong>@lang('general.price')</strong></td>
                    <td align="right"><strong>@lang('general.quantity')</strong></td>
                    <td align="right"><strong>@lang('general.total')</strong></td>
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
                                <i style="text-decoration: line-through;">{{ money_currency($product->cart_line_value) }}</i>
                                {{ money_currency($product->cart_discount_line_value) }}
                            @else
                                {{ money_currency($product->cart_line_value) }}
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
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 8px 0;" align="right"><strong>- {{ money_currency($orderService->getDiscount($order)) }}</strong></td>
                </tr>
                <tr style="color: #DA7612; font-size: 18px;">
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 10px 0;"><strong>Grand total</strong></td>
                    <td colspan="2" style="border-top: 1px solid #bfbfbf; margin: 0; padding: 10px 0;" align="right"><strong>{{ money_currency($orderService->getBigTotal($order)) }}</strong></td>
                </tr>
            </tbody>
        </table>
        <div style="text-align: center;">
            <a href="{{ locale_route('account.index') }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #da7612; text-decoration:none;" target="_blank">
                @lang('mail.check_order_progress')
            </a>
        </div>
        <p style="text-align: justify;">
            @lang('mail.bottom_register_msg', [
                'contact' => config('company.email_1')
            ]).
        </p>
    </td>
</tr>