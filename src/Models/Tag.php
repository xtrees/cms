<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * XTrees\CMS\Models\Tag
 *
 * @property int $id
 * @property int $tag_group_id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $keywords
 * @property string $summary
 * @property int $total 总数
 * @property int $position 位置
 * @property int $display
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Content[] $contents
 * @property-read int|null $contents_count
 * @property-read string $url
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTagGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    const PS_NONE = 0;
    const PS_CLOUD = 1; //标签云

    use HasFactory;

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'taggable',
            'tag_id', 'content_id', 'id');
    }


    public function getUrlAttribute(): string
    {
        return route('tag.show', ['slug' => $this->slug]);
    }
}
