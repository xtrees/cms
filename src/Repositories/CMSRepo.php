<?php
namespace XTrees\CMS\Repositories;
use Illuminate\Database\Eloquent\Builder;
use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Content;

class CMSRepo
{
    /**
     * global category query builder
     * @return Builder
     */
    public function categoryBuilder(): Builder
    {
        return Category::query()->where('display', true);
    }

    /**
     * find category by slug
     * @param string $slug
     * @return Category|object|null
     */
    public function categorySlug(string $slug)
    {
        return $this->categoryBuilder()->where('slug', $slug)->first();
    }

    /**
     * global category query builder
     * @return Builder
     */
    public function contentBuilder(): Builder
    {
        return Content::query()->where('display', true);
    }

    /**
     * @param int $id
     * @return Content|object|null
     */
    public function content(int $id): ?Content
    {
        return $this->contentBuilder()->find($id);
    }
}
