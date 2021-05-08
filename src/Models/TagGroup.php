<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\SortableTrait;

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
