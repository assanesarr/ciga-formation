<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User config
    |--------------------------------------------------------------------------
    |
    | Here you can specify voyager user configs
    |
    */

    'user' => [
        'add_default_role_on_register' => true,
        'default_role'                 => 'user',
        'default_avatar'               => 'users/default.png',
        'redirect'                     => '/admin',
    ],


    'prefix' => env('PREFIX_DASHBOARD', 'administrator'),


    'assets' => env('ASSET_URL', 'ciga'),


    /*
    |--------------------------------------------------------------------------
    | Controllers config
    |--------------------------------------------------------------------------
    |
    | Here you can specify voyager controller settings
    |
    */

    'controllers' => [
        'namespace' => 'Chicorycom\\Cigaformation\\Http\\Controllers',
    ],


    /*
    |--------------------------------------------------------------------------
    | Storage Config
    |--------------------------------------------------------------------------
    |
    | Here you can specify attributes related to your application file system
    |
    */
    'storage' => [
        'disk' => env('FILESYSTEM_DRIVER', 'public'),
    ],

    /*
   |--------------------------------------------------------------------------
   | UI Generic Config
   |--------------------------------------------------------------------------
   |
   | Here you change some of the Voyager UI settings.
   |
   */

    'primary_color' => env('PRIMARY_COLOR', '#22A7F0'),


    'googlemaps' => [
        'key'    => env('GOOGLE_MAPS_KEY', ''),
        'center' => [
            'lat' => env('GOOGLE_MAPS_DEFAULT_CENTER_LAT', '32.715738'),
            'lng' => env('GOOGLE_MAPS_DEFAULT_CENTER_LNG', '-117.161084'),
        ],
        'zoom' => env('GOOGLE_MAPS_DEFAULT_ZOOM', 11),
    ],
];
