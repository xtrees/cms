<?php


namespace XTrees\CMS\Http\Controllers\Web;


use Illuminate\Http\Request;
use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Content;
use XTrees\CMS\Repositories\CMSRepo;

class ContentController extends WebController
{
    public function index()
    {

    }

    public function show(Category $category, Content $content, Request $request, CMSRepo $repo)
    {
        $view = $content->view();
        $page = $request->input('page', 1);
        $galleries = $video = null;
        if ($content->isGallery()) {
            $galleries = $repo->galleries($content, $page, 5);
        }

        $prev = $repo->prevContent($category, $content);
        $next = $repo->nextContent($category, $content);
        $related = $repo->relatedContent($category, $content);
        return cms_view($view,
            compact('category', 'content', 'video', 'galleries', 'page', 'prev', 'next', 'related'));
    }
}
