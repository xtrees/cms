<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * XTrees\CMS\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property string $price 每天价格
 * @property int $permission 权限等级
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role wherePermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    const UNLIMITED = -1;

    protected $fillable = ['name', 'icon', 'permission'];

    public function unlimited(): bool
    {
        return $this->permission == self::UNLIMITED;
    }
}
