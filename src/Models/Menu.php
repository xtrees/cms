<?php


namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     * 顶级菜单
     * @return HasMany
     */
    public function parentItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id');
    }
}
