<?php

use XTrees\CMS\Http\Controllers\Web\Auth\AuthenticatedSessionController;
use XTrees\CMS\Http\Controllers\Web\Auth\NewPasswordController;
use XTrees\CMS\Http\Controllers\Web\Auth\PasswordResetLinkController;
use XTrees\CMS\Http\Controllers\Web\Auth\RegisteredUserController;
use XTrees\CMS\Http\Controllers\Web\CategoryController;
use XTrees\CMS\Http\Controllers\Web\ContentController;
use XTrees\CMS\Http\Controllers\Web\HistoryController;
use XTrees\CMS\Http\Controllers\Web\HomeController;
use XTrees\CMS\Http\Controllers\Web\PageController;
use XTrees\CMS\Http\Controllers\Web\SearchController;
use XTrees\CMS\Http\Controllers\Web\SitemapController;
use XTrees\CMS\Http\Controllers\Web\TagController;
use XTrees\CMS\Http\Controllers\Web\UserController;
use XTrees\CMS\Http\Controllers\Web\WalletController;

Route::group(['middleware' => config('cms.routes.middleware')], function () {
    //home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //category
    Route::get('{category:slug}', [CategoryController::class, 'show'])
        ->where('category', '[0-9a-z\-]+')
        ->name('category');

    //recent contents list
    Route::get('contents', [ContentController::class, 'index'])->name('content');

    Route::get('{category:slug}/{content:id}.html', [ContentController::class, 'show'])
        ->name('content.show')
        ->where('category', '[0-9a-z\-]+')
        ->where('id', '[0-9]+');

    Route::get('tags', [TagController::class, 'index'])->name('tag');
    Route::get('tags/{slug}', [TagController::class, 'show'])->name('tag.show');

    Route::get('search', [SearchController::class, 'index'])->name('search');

    Route::get('search/{keyword}', [SearchController::class, 'show'])->name('search.show');

    Route::get('{page:slug}.html', [PageController::class, 'show'])->name('page');


    Route::prefix('users')->middleware('guest')->group(function () {
        //注册
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('users.register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
        //登录
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('users.login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        //忘记密码
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('users.password.request');
        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('users.password.email');
        //重置密码
        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('users.password.reset');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('users.password.update');
    });

    Route::prefix('users')->middleware('cms.auth')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('users.logout');

        Route::get('home', [UserController::class, 'index'])->name('users.home');

        Route::post('update', [UserController::class, 'update'])->name('users.update');
        Route::post('password', [UserController::class, 'password'])->name('users.password');

        Route::get('history/purchased', [HistoryController::class, 'purchased'])->name('users.history.purchased');
        Route::get('history/favorites', [HistoryController::class, 'favorites'])->name('users.history.favorites');

        Route::get('wallet/vip', [WalletController::class, 'vips'])->name('users.wallet.vip');
        Route::post('wallet/vip', [WalletController::class, 'createVIPOrder']);
        Route::get('wallet/coins', [WalletController::class, 'coins'])->name('users.wallet.coin');
        Route::post('wallet/coins', [WalletController::class, 'createCoinOrder']);
        Route::post('wallet/pay', [WalletController::class, 'pay'])->name('users.wallet.pay');
        Route::get('wallet/orders', [WalletController::class, 'orders'])->name('users.wallet.order');

    });


    Route::group(['prefix' => 'sitemap'], function () {
        Route::get('index.xml', [SitemapController::class, 'index'])->name('sitemap');
        Route::get('content-{page}.xml', [SitemapController::class, 'content'])
            ->where('page', '[0-9]+')
            ->name('sitemap.content');
        Route::get('tag-{page}.xml', [SitemapController::class, 'tag'])
            ->name('sitemap.tag')
            ->where('page', '[0-9]+');
        Route::get('page-{page}.xml', [SitemapController::class, 'page'])
            ->name('sitemap.tag')
            ->where('page', '[0-9]+');
    });

});


