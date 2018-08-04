{{ mb_strtoupper(trans('general.your_coupon')) }}<br /><br /><br />
{{ mb_strtoupper($coupon->code) }}<br />
@lang('mail.top_coupon_msg', ['name' => $user->format_first_name]).<br /><br />
@lang('mail.body_coupon_msg' ,  ['discount' => money_currency($coupon->promo)]).<br /><br />
<a href="{{ locale_route('products.index') }}" target="_blank">@lang('mail.shop_now')</a><br /><br />
@lang('mail.bottom_register_msg', ['contact' => config('company.email_1')]).<br /><br />
@lang('general.admin_thanks', ['app' => config('app.name')])<br /><br /><br />
&copy; 2018 {{ config('app.name') }}, @lang('general.right').