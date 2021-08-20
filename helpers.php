<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HtmlString;
use XTrees\CMS\Repositories\CMSRepo;
use XTrees\CMS\Repositories\MenuRepo;

function cms_view($view = null, $data = [], $mergeData = [])
{
    $prefix = config('cms.theme');
    $view = empty($prefix) ? $view : $prefix . '.' . $view;
    return view($view, $data, $mergeData);
}

function menus(string $slug, string $view = 'cms::menu.default', $options = []): HtmlString
{
    $items = MenuRepo::menus($slug);
    return new HtmlString(
        \Illuminate\Support\Facades\View::make($view, ['items' => $items, 'options' => $options])->render()
    );
}

function collection(string $slug, $limit = 0): Collection
{
    return (new CMSRepo())->collectionBySlug($slug, $limit);
}

function obg($obj, $key, $default = null)
{
    return data_get($obj, $key, $default);
}

function image_get($obj, $key)
{
    return data_get($obj, $key, config('cms.image.holder'));
}

function cover_get($content, $key)
{
    return data_get($content, $key, config('cms.image.cover'));
}

function avatar_get($content, $key)
{
    return data_get($content, $key, config('cms.image.avatar'));
}

function lazy($url)
{
    return is_search_engine() ? $url : config('cms.image.cover');
}

function page_title($page = 1): string
{
    return "第{$page}页-";
}

function is_search_engine()
{
    if (is_null(config('cms.useragent.engine'))) {
        $ua = Request::userAgent();
        $engines = config('cms.useragent.search');
        foreach ($engines as $engine) {
            if (strpos($ua, $engine)) {
                config(['cms.useragent.engine', true]);
                return true;
            }
        }
    }
    return config('cms.useragent.engine', false);
}


function route_active($name): string
{
    return Route::is($name) ? 'active' : '';
}
