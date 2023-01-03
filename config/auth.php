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

        /**
         * Default (WEB + API)
         */
        'web' => [
            'driver'   => 'session',
            'provider' => 'administrators',
        ],
        'api' => [
            'driver'   => 'token',
            'provider' => 'administrators',
        ],

        /**
         * Admin (WEB)
         */
        'administrator' => [
            'driver'   => 'session',
            'provider' => 'administrators',
        ],

        /**
         * Drone (WEB + API)
         */
        'drone' => [
            'driver'   => 'session',
            'provider' => 'drones',
        ],
        'api_drone' => [
            'driver'   => 'token',
            'provider' => 'api_drones',
            'hash'     => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        /**
         * Admin (WEB)
         */
        'administrators' => [
            'driver' => 'eloquent',
            'model'  => App\Models\System\Management\Administrator::class,
        ],

        /**
         * Drone (WEB + API)
         */
        'drones' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Drone::class,
        ],
        'api_drones' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Drone::class,
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
