<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'taggable',
            'tag_id', 'content_id', 'id');
    }
}
