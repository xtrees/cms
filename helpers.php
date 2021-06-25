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

function collection(string $slug): Collection
{
    return (new CMSRepo())->collectionBySlug($slug);
}

function obg($obj, $key, $default = null)
{
    return data_get($obj, $key, $default);
}
