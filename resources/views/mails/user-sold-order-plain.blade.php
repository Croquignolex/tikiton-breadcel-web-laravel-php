{{ mb_strtoupper(trans('general.your_order')) }}<br /><br /><br />
{{ mb_strtoupper($order->format_status->label) }}<br />
@lang('mail.top_sold_order_msg', ['name' => $order->user->format_first_name]).<br /><br />
@lang('mail.body_sold_order_msg' , ['date' => $order->user->created_date . ' ' . trans('general.at') . ' ' . $order->user->created_time]).<br /><br />
<a href="{{ locale_route('account.index') }}" target="_blank">@lang('mail.check_order_progress')</a><br /><br />
@lang('mail.bottom_register_msg', ['contact' => config('company.email_1')]).<br /><br />
@lang('general.admin_thanks', ['app' => config('app.name')])<br /><br /><br />
&copy; 2018 {{ config('app.name') }}, @lang('general.right').