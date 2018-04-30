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
    'phone' => env('COMPANY_PHONE', '0000'),
    'email' => env('COMPANY_EMAIL', 'hello@example.com'),
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
