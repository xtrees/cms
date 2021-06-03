<?php


use XTrees\CMS\Http\Controllers\Web\CategoryController;
use XTrees\CMS\Http\Controllers\Web\HomeController;
use XTrees\CMS\Http\Controllers\Web\PageController;
use XTrees\CMS\Http\Controllers\Web\SearchController;
use XTrees\CMS\Http\Controllers\Web\TagController;

Route::group(['middleware' => 'web'], function () {
    //home
    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get('{category:slug}', [CategoryController::class, 'show'])
        ->where('category', '[0-9a-z\-]+')
        ->name('category');

    Route::get('{category:slug}/{id}.html', [CategoryController::class, 'contents'])
        ->where('category', '[0-9a-z\-]+')
        ->where('id', '[0-9]+')
        ->name('content');


    Route::get('tags.html', [TagController::class, 'index'])->name('tag');
    Route::get('tags/{slug}', [TagController::class, 'show'])->name('tag.show');


    Route::get('search', [SearchController::class, 'index'])->name('search');

    Route::get('search/{keyword}', [SearchController::class, 'show'])->name('search.show');

    Route::get('{page:slug}.html', [PageController::class, 'show'])->name('page');
});
