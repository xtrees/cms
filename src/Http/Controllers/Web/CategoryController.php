<?php


namespace XTrees\CMS\Http\Controllers\Web;


use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Content;

class CategoryController extends WebController
{
    public function show(Category $category)
    {
        dd($category);
    }

    public function contents(Category $category, Content $content)
    {
    }

}
