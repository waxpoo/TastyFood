<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default authentication "guard" and "password
    | reset" options for your application. You may change these defaults
    | as required, but they're a good start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may configure the guards for your application. Guards define how
    | users are authenticated for each request. By default, Laravel includes
    | a "web" guard and an "api" guard for you to use.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved from your database or other storage
    | mechanisms used by this application to persist your users.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Options
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one table or model. The settings here control the duration of
    | the password reset link and the name of the table for storing tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes a password reset request
    | should be valid for. This will help you control the length of time
    | the reset link is valid and how often users can reset their password.
    |
    */

    'password_timeout' => 10800,

];
