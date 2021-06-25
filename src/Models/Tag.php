<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
