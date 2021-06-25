<?php


namespace XTrees\CMS\Repositories;


use Illuminate\Database\Eloquent\Collection;
use XTrees\CMS\Models\Menu;

class MenuRepo
{
    public static function menus($slug): Collection
    {
        /** @var Menu $menu */
        $menu = Menu::query()->where('slug', $slug)->firstOrFail();
        $items = $menu->parentItems()->with('children')->get();
        return $items->sortBy('sort');
    }
}
