{{ mb_strtoupper(trans('auth.account_validation')) }}<br /><br /><br />
@lang('mail.top_register_msg', ['name' => $user->format_first_name]).<br /><br />
@lang('mail.body_register_msg' , ['date' => $user->created_date . ' ' . trans('general.at') . ' ' . $user->created_time]).<br /><br />
<a href="{{ $user->confirmation_link }}" target="_blank">@lang('mail.validate_my_account')</a><br /><br />
@lang('mail.bottom_register_msg', ['contact' => config('company.email_1')]).<br /><br />
@lang('general.admin_thanks', ['app' => config('app.name')])<br /><br /><br />
&copy; 2018 {{ config('app.name') }}, @lang('general.right').