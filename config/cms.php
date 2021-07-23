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

    'image' => [
        'holder' => env('CMS_IMAGE_HOLDER', 'https://via.placeholder.com/300.png'),
        'cover' => env('CMS_IMAGE_COVER', 'https://via.placeholder.com/300.png'),//default cover
    ],

    'useragent' => [
        'search' => ['baidu', '360'],
    ]
];
