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

function obj_image($obj, $key)
{
    return data_get($obj, $key, config('cms.view.image_holder'));
}

function page_title($page = 1): string
{
    return "第{$page}页";
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

function lazy($url): HtmlString
{
    if (is_search_engine()) {
        $html = " src=\"$url\" ";
    } else {
        $default = config('cms.view.image_holder');
        $html = " src=\"$default\" data-src=\"$url\" ";
    }
    return new HtmlString($html);
}
