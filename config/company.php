<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Information
    |--------------------------------------------------------------------------
    |
    |
    */
    'name' => env('COMPANY_NAME', 'Laravel'),
    'slogan' => env('COMPANY_SLOGAN', 'Laravel'),
    'phone_1' => env('COMPANY_PHONE_1', '0000'),
    'phone_2' => env('COMPANY_PHONE_2', '0000'),
    'address_1' => env('COMPANY_ADDRESS_1', 'Address'),
    'address_2' => env('COMPANY_ADDRESS_2', 'Address'),
    'email_1' => env('COMPANY_EMAIL_1', 'hello@example.com'),
    'email_2' => env('COMPANY_EMAIL_2', 'hello@example.com'),
    'web_site' => env('COMPANY_WEB_SITE', 'http://laravel.com'),

    /*
   |--------------------------------------------------------------------------
   | Mailing
   |--------------------------------------------------------------------------
   |
   |
   */
    'no-reply' => [
        'address' => env('COMPANY_NO_REPLY_MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('COMPANY_NO_REPLY_MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Social medias
    |--------------------------------------------------------------------------
    |
    |
    */
    'facebook' => env('COMPANY_FACEBOOK', 'facebook'),
    'twitter' => env('COMPANY_TWITTER', 'twitter'),
    'linked_in' => env('COMPANY_LINKED_IN', 'linked in'),
    'google_plus' => env('COMPANY_GOOGLE_PLUS', 'google plus'),
    'youtube' => env('COMPANY_YOUTUBE', 'youtube'),
];
