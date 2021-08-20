<?php

return [
    'logo' => [
        'small' => env('CMS_LOGO_SMALL', ''),
        'normal' => env('CMS_LOGO_NORMAL', ''),
        'large' => env('CMS_LOGO_LARGE', ''),
    ],
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
        'avatar' => env('CMS_IMAGE_AVATAR', 'https://via.placeholder.com/100.png'),
        'gavatar' => [
            'on' => env('CMS_GAVATAR', true),
            'mirror'=>env('CMS_GAVATAR_MIRROR','https://cdn.v2ex.com/gravatar/')
        ]
    ],

    'useragent' => [
        'search' => ['baidu', '360'],
    ]
];
