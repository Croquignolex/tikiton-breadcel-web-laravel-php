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

    'required'             => 'Ce champ est réquis',
    'string'               => 'Ce champ doit être une chaîne de charactères',
    'email'                => 'Ce champ doit être une addresse mail valide',
    'unique'               => 'Ce champ doit être unique',
    'confirmed'            => 'Ce champ doit être confimé',
    'numeric'              => 'Ce champ doit être un entier',
    'max'                  => [
        'numeric' => 'Ce champ doit contenir au plus une valeur de :max',
        'string'  => 'Ce champ doit contenir :max charactères au plus'
    ],
    'min'                  => [
        'numeric' => 'Ce champ doit contenir au moins une valeur de :min',
        'string'  => 'Ce champ doit contenir :min charactères au moins'
    ],
    'between'              => [
        'numeric' => 'Ce champ doit contenir une valeur entre :min et :max',
        'file'    => 'La taille de ce fichier doit être entre :min et :max kilobites',
        'string'  => 'Ce champ doit contenir entre :min et :max charactères'
    ],
];
