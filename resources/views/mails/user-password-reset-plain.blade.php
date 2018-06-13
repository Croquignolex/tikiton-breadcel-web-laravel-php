{{ mb_strtoupper(trans('auth.reset_pwd')) }}<br /><br /><br />
@lang('mail.top_password_reset_msg', ['name' => $user->format_name]).<br /><br />
@lang('mail.body_password_reset_msg' , ['date' => $user->created_date . ' ' . trans('general.at') . ' ' . $user->created_time]).<br /><br />
<a href="{{ $password_reset->reset_link }}" target="_blank">@lang('mail.reset_my_password')</a><br /><br />
@lang('mail.bottom_register_msg', ['contact' => config('company.email_1')]).<br /><br />
@lang('general.admin_thanks', ['app' => config('app.name')])<br /><br /><br />
&copy; 2018 {{ config('app.name') }}, @lang('general.right').