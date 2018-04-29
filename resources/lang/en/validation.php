<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'required'             => 'This field is required.',
    'string'               => 'This field must be a string.',
    'email'                => 'This field must be a valid email address.',
    'unique'               => 'This field must be required.',
    'confirmed'            => 'This field must be confirmed.',
    'max'                  => [
        'numeric' => 'This field may not be greater than :max.',
        'string'  => 'This field may not be greater than :max characters.'
    ],
    'min'                  => [
        'numeric' => 'This field must be at least :min.',
        'string'  => 'This field must be at least :min characters.'
    ]
];
