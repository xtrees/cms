<?php

return [
    'routes' => [
        'enable' => true,
        'middleware' => 'web'
    ],

    'api' => [],
    //用户的类
    'user_class' => \App\Models\User::class,

    'view' => [
        'theme' => '',
        'image_holder' => env('IMAGE_HOLDER', 'https://via.placeholder.com/300.png'),
    ],

    'useragent' => [
        'search' => ['baidu', '360'],
    ]
];
