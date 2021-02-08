<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
		
		
		
		'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
		
		'superadmin' => [
            'driver' => 'session',
            'provider' => 'superadmins',
        ]
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
		
		'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class,
        ],
		
		'superadmins' => [
            'driver' => 'eloquent',
            'model' => App\SuperAdmin::class,
        ]
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 120,
            'throttle' => 60,
        ],
		
		'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 120,
        ],
		
		'superadmins' => [
            'provider' => 'superadmins',
            'table' => 'password_resets',
            'expire' => 120,
        ],
    ],

    'password_timeout' => 10800,
];
