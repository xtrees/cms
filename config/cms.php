<?php

return [
    'routes' => [
        'enable' => true,
        'middleware' => 'web'
    ],

    'api' => [

    ],
    //用户的类
    'user_class' => \App\Models\User::class,

    'view' => [
        'theme' => ''
    ]
];
