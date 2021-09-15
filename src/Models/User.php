<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use XTrees\CMS\Database\Factories\UserFactory;

/**
 * XTrees\CMS\Models\User
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $avatar
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int $coins 金币数量
 * @property int $blocked 锁定
 * @property string $source 注册来源
 * @property string|null $activated_at 活跃时间
 * @property int $robot
 * @property string|null $role_expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRobot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $sex -1保密0女1男
 * @property-read mixed $avatar_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\XTrees\CMS\Models\Order[] $order
 * @property-read int|null $order_count
 * @property-read \XTrees\CMS\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'sex',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getSexAttribute()
    {
        $val = data_get($this->attributes, 'sex');
        return is_null($val) ? -1 : $val;
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            if (strpos('http', $this->avatar)) {
                return $this->avatar;
            }
            return Storage::disk('avatar')->url($this->avatar);
        } else if (config('cms.image.gavatar.on')) {
            return config('cms.image.gavatar.mirror') . md5($this->email);
        }
        return config('cms.image.avatar');
    }

    public static function factory(...$parameters): UserFactory
    {
        return UserFactory::new();
    }
}
