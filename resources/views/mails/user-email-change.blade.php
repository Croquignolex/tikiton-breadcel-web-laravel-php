@extends('layouts.mail')

@section('title', page_title(trans('auth.change_email')))

@section('head', mb_strtoupper(trans('auth.account_validation')))

@section('body')
    <tr>
        <td>
            <p style="text-align: justify;">
                <strong>
                    @lang('mail.top_register_msg', ['name' => $user->format_first_name]).
                </strong>
            </p>
            <p style="text-align: justify;">
                @lang('mail.body_change_email_msg' , ['date' => $user->created_date .
                    ' ' . trans('general.at') .
                    ' ' . $user->created_time
                ]).
            </p>
            <div style="text-align: center;">
                <a href="{{ $user->confirmation_link }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #da7612; text-decoration:none;" target="_blank">
                    @lang('mail.validate_my_account')
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
