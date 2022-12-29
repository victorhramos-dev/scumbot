<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Enabled
    |--------------------------------------------------------------------------
    */
    'register' => false,

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard'     => 'administrator',
        'passwords' => 'administrators',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'administrators',
        ],
        'api' => [
            'driver'   => 'token',
            'provider' => 'administrators',
        ],
        'administrator' => [
            'driver'   => 'session',
            'provider' => 'administrators',
        ],
        'player' => [
            'driver'   => 'session',
            'provider' => 'players',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'administrators' => [
            'driver' => 'eloquent',
            'model'  => App\Models\System\Management\Administrator::class,
        ],
        'players' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Business\Players\Player::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'administrators' => [
            'provider' => 'administrators',
            'table'    => 'administrator_password_resets',
            'expire'   => 60,
        ],
        'players' => [
            'provider' => 'players',
            'table'    => 'player_password_resets',
            'expire'   => 60,
        ],
    ],
];
