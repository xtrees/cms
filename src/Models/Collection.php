<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collection extends Model
{
    protected $fillable = ['name', 'slug', 'title', 'keywords', 'summary', 'sort'];

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'collection_contents')->withPivot('sort');
    }
}
