<?php


namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * XTrees\CMS\Models\Offer
 *
 * @property int $id
 * @property int $type
 * @property string $origin 原价
 * @property string $price 单价
 * @property int|null $role_id
 * @property int $duration 时长,day|金币数量
 * @property string|null $detail
 * @property int $sort
 * @property int $display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Offer extends Model
{
    const COIN = 0;
    const VIP = 1;

    const STATUS_FAILED = -2;
    const STATUS_TIMEOUT = -1;
    const STATUS_WAITING = 0;
    const STATUS_PAID = 1;
    const STATUS_FINISHED = 2;

    protected $fillable = ['type', 'origin', 'price', 'role_id', 'detail', 'duration', 'sort', 'display'];

}
