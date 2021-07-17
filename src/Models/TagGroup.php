<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\SortableTrait;

/**
 * XTrees\CMS\Models\TagGroup
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $keywords
 * @property string $summary
 * @property int $sort
 * @property int $display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TagGroup extends Model
{
    use HasFactory, SortableTrait;

    protected $fillable = ['name', 'title', 'keywords', 'summary', 'sort'];

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'group_id');
    }
}
