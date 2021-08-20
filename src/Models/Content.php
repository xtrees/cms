<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use XTrees\CMS\Database\Factories\CategoryFactory;
use XTrees\CMS\Database\Factories\ContentFactory;
use XTrees\CMS\Repositories\CMSRepo;

/**
 * XTrees\CMS\Models\Content
 *
 * @property int $id
 * @property int|null $category_id
 * @property int $type 内容类型
 * @property string|null $slug
 * @property string $title
 * @property string $keywords
 * @property string $summary
 * @property string|null $body
 * @property int $views
 * @property int $favorites
 * @property int $permission 权限等级
 * @property int $coins 金币
 * @property string|null $published_at
 * @property int $display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \XTrees\CMS\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Collection[] $collections
 * @property-read int|null $collections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Image[] $covers
 * @property-read int|null $covers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Image[] $gallery
 * @property-read int|null $gallery_count
 * @property-read string $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \XTrees\CMS\Models\Image|null $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereFavorites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereViews($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    const ARTICLE = 1;
    const GALLERY = 2;
    const VIDEO = 3;

    const TYPE_KEYS = [
        0 => self::ARTICLE,
        1 => self::GALLERY,
        2 => self::VIDEO,
    ];

    const TYPE_NAMES = [
        self::ARTICLE => '文章',
        self::GALLERY => '图集',
        self::VIDEO => '视频',
    ];

    use HasFactory;

    protected $fillable = [
        'category_id', 'type', 'slug', 'title', 'keywords', 'summary', 'body', 'views', 'favorites', 'level'
    ];

    public static function factory(...$parameters): ContentFactory
    {
        return ContentFactory::new();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new CMSRepo())->contentBuilder()->where($field ?? $this->getRouteKeyName(), $value)->first();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 是否为图集
     * @return bool
     */
    public function isGallery(): bool
    {
        return $this->type == self::GALLERY;
    }

    /**
     * 是否为文章
     * @return bool
     */
    public function isArticle(): bool
    {
        return $this->type == self::ARTICLE;
    }

    /**
     * 是否为视频
     * @return bool
     */
    public function isVideo(): bool
    {
        return $this->type == self::VIDEO;
    }

    public function view(): string
    {
        switch ($this->type) {
            case self::GALLERY:
                return 'cms::content.gallery';
            case self::VIDEO:
                return 'cms::content.video';
        }
        return 'cms::content.article';
    }

    /**
     * 图片合集
     * @return HasMany
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(Image::class)->where('cover', false);
    }

    public function covers(): HasMany
    {
        return $this->hasMany(Image::class)->where('cover', true);
    }

    /**
     * 首个封面
     * @return HasOne
     */
    public function thumbnail(): HasOne
    {
        return $this->hasOne(Image::class)->where('cover', true);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * 内容合集
     * @return BelongsToMany
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'content_collection');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getUrlAttribute(): string
    {
        return route('content.show', ['category' => data_get($this, 'category.slug'), 'content' => $this->id]);
    }
}
