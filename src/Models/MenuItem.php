<?php


namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * XTrees\CMS\Models\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property string $title
 * @property string|null $icon
 * @property string|null $url
 * @property string $target
 * @property int|null $parent_id
 * @property int $sort
 * @property int $display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|MenuItem[] $children
 * @property-read int|null $children_count
 * @property-read string|null $active
 * @property-read \XTrees\CMS\Models\Menu $menu
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereUrl($value)
 * @mixin \Eloquent
 */
class MenuItem extends Model
{

    protected $fillable = [
        'menu_id', 'title', 'slug', 'url', 'target', 'parent_id', 'sort', 'display'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort');
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }


    public function getActiveAttribute(): ?string
    {
        return url()->current() == $this->url ? 'active' : null;
    }
}
