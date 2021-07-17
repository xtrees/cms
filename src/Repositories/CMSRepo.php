<?php

namespace XTrees\CMS\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
     * @return Builder|Model|object|null
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
     * @param Content $content
     * @param $page
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public function galleries(Content $content, $page, $pageSize = 20): LengthAwarePaginator
    {
        return $content->gallery()
            ->orderBy('sort')
            ->where('display', true)
            ->paginate($pageSize, ['*'], 'page', $page);
    }

    public function prevContent(Category $category, Content $content)
    {
        return $this->contentBuilder()->where('category_id', $category->id)
            ->where('id', '<', $content->id)
            ->first();
    }

    public function nextContent(Category $category, Content $content)
    {
        return $this->contentBuilder()->where('category_id', $category->id)
            ->where('id', '>', $content->id)
            ->first();
    }

    public function relatedContent(Category $category, Content $content, $limit = 8)
    {
        return $this->contentBuilder()->where('category_id', $category->id)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
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
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function collectionBySlug(string $slug, int $limit = 0): \Illuminate\Database\Eloquent\Collection
    {
        /** @var Collection $collection */
        $collection = Collection::query()->where('slug', $slug)->first();
        if ($collection) {
            $builder = $collection->contents()
                ->where('display', true)
                ->with('category')
                ->with('thumbnail')
                ->orderBy('sort');
            if ($limit) {
                $builder = $builder->limit($limit);
            }
            return $builder->get();
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
