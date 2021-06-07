<?php

use XTrees\CMS\Http\Controllers\Web\AuthController;
use XTrees\CMS\Http\Controllers\Web\CategoryController;
use XTrees\CMS\Http\Controllers\Web\ContentController;
use XTrees\CMS\Http\Controllers\Web\HomeController;
use XTrees\CMS\Http\Controllers\Web\PageController;
use XTrees\CMS\Http\Controllers\Web\SearchController;
use XTrees\CMS\Http\Controllers\Web\SitemapController;
use XTrees\CMS\Http\Controllers\Web\TagController;
use XTrees\CMS\Http\Controllers\Web\UserController;

Route::group(['middleware' => config('cms.routes.middleware')], function () {
    //home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //category
    Route::get('{category:slug}', [CategoryController::class, 'show'])
        ->where('category', '[0-9a-z\-]+')
        ->name('category');

    //recent contents list
    Route::get('contents', [ContentController::class, 'index'])->name('content');

    Route::get('{category:slug}/{id}.html', [ContentController::class, 'show'])
        ->where('category', '[0-9a-z\-]+')
        ->where('id', '[0-9]+')
        ->name('content.show');

    Route::get('tags', [TagController::class, 'index'])->name('tag');
    Route::get('tags/{slug}', [TagController::class, 'show'])->name('tag.show');

    Route::get('search', [SearchController::class, 'index'])->name('search');

    Route::get('search/{keyword}', [SearchController::class, 'show'])->name('search.show');

    Route::get('{page:slug}.html', [PageController::class, 'show'])->name('page');


    Route::prefix('users')->group(function () {
        //注册
        Route::get('/register', [UserController::class, 'create'])
            ->middleware('guest')
            ->name('users.register');

        Route::post('/register', [UserController::class, 'store'])
            ->middleware('guest');

        //登录
        Route::get('/login', [AuthController::class, 'create'])
            ->middleware('guest')
            ->name('login');

        Route::post('/login', [AuthController::class, 'store'])
            ->middleware('guest');

        //忘记密码
        Route::get('/forgot-password', [UserController::class, 'createPasswordReset'])
            ->middleware('guest')
            ->name('password.request');
        Route::post('/forgot-password', [UserController::class, 'storePasswordReset'])
            ->middleware('guest')
            ->name('password.email');
        Route::get('/reset-password/{token}', [UserController::class, 'createNewPassword'])
            ->middleware('guest')
            ->name('password.reset');
        Route::post('/reset-password', [UserController::class, 'storeNewPassword'])
            ->middleware('guest')
            ->name('password.update');
    });



    Route::group(['prefix' => 'sitemap'], function () {
        Route::get('index.xml', [SitemapController::class, 'index'])->name('sitemap');
        Route::get('content-{page}.xml', [SitemapController::class, 'content'])
            ->where('page', '[0-9]+')
            ->name('sitemap.content');
        Route::get('tag-{page}.xml', [SitemapController::class, 'tag'])
            ->where('page', '[0-9]+')
            ->name('sitemap.tag');
        Route::get('page-{page}.xml', [SitemapController::class, 'page'])
            ->where('page', '[0-9]+')
            ->name('sitemap.tag');
    });

});
