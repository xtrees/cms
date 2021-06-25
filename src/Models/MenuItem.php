<?php


namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
