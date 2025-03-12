<?php

return [

   
    
    'defaults' => [
        'guard' => 'admin',
        'passwords' => 'admins',
    ],

   

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [ // Ensure this exists
        'driver' => 'session',
        'provider' => 'admins',
    ],
],
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class, // Ensure you have an Admin model
    ],
],


    

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [ 
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

   

    'password_timeout' => 10800,

];
