@extends('layouts.mail')

@section('title', page_title(trans('general.pwd_reset')))

@section('head', mb_strtoupper(trans('auth.reset_pwd')))

@section('body')
    <tr>
        <td>
            <p style="text-align: justify;">
                <strong>
                    @lang('mail.top_password_reset_msg', ['name' => $user->format_name]).
                </strong>
            </p>
            <p style="text-align: justify;">
                @lang('mail.body_password_reset_msg' , ['date' => $user->created_date .
                    ' ' . trans('general.at') .
                    ' ' . $user->created_time
                ]).
            </p>
            <div style="text-align: center;">
                <a href="{{ $password_reset->reset_link }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #da2013; text-decoration:none;" target="_blank">
                    @lang('mail.reset_my_password')
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

