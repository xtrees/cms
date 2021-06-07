<?php


namespace XTrees\CMS\Http\Controllers\Web;


use XTrees\CMS\Models\Category;

class CategoryController extends WebController
{
    public function show(Category $category)
    {
        return cms_view('category.show', compact('category'));
    }
}
