<?php

namespace XTrees\CMS\Repositories;

use Illuminate\Database\Eloquent\Builder;
use XTrees\CMS\Models\Category;
use XTrees\CMS\Models\Collection;
use XTrees\CMS\Models\Content;
use XTrees\CMS\Models\Tag;

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
     * @param int $id
     * @return Content|object|null
     */
    public function content(int $id): ?Content
    {
        return $this->contentBuilder()->find($id);
    }

    /**
     * global category query builder
     * @return Builder
     */
    public function contentBuilder(): Builder
    {
        return Content::query()
            ->with('category')
            ->with('thumbnail')
            ->where('display', true);
    }

    /**
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function collectionBySlug(string $slug): \Illuminate\Database\Eloquent\Collection
    {
        /** @var Collection $collection */
        $collection = Collection::query()->where('slug', $slug)->first();
        if ($collection) {
            return $collection->contents()
                ->where('display', true)
                ->with('category')
                ->with('thumbnail')
                ->orderBy('sort')
                ->get();
        }
        return new \Illuminate\Database\Eloquent\Collection();
    }

    /**
     * @param int $position
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tagPosition(int $position = Tag::PS_CLOUD, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return Tag::query()->where('position', $position)
            ->where('display', true)
            ->limit($limit)->get();
    }
}
