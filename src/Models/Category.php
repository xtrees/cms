<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use XTrees\CMS\Database\Factories\CategoryFactory;
use XTrees\CMS\Repositories\CMSRepo;

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
