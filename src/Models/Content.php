<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Content extends Model
{
    const ARTICLE = 'article';
    const GALLERY = 'gallery';
    const VIDEO = 'video';

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
    public function firstCover(): HasOne
    {
        return $this->hasOne(Image::class)->where('cover', true);
    }

    public function tags(): MorphToMany
    {
        return $this->morphedByMany(Tag::class, 'taggable');
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
}