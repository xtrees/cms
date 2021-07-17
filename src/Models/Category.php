<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use XTrees\CMS\Database\Factories\CategoryFactory;
use XTrees\CMS\Repositories\CMSRepo;

/**
 * XTrees\CMS\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $keywords
 * @property string $summary
 * @property int $total 总计文章
 * @property int $sort
 * @property int $permission 权限等级
 * @property bool $display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Content[] $contents
 * @property-read int|null $contents_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'title', 'keywords', 'summary', 'total', 'sort', 'display'];

    protected $casts = [
        'total' => 'integer',
        'display' => 'boolean'
    ];

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }


    public static function factory(...$parameters): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new CMSRepo())->categoryBuilder()->where($field ?? $this->getRouteKeyName(), $value)->first();
    }
}
