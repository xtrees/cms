<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * XTrees\CMS\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $offer_id
 * @property int|null $coupon_id 优惠券
 * @property string $no
 * @property string|null $outer_no 外部订单号
 * @property string $price
 * @property int $amount 数量
 * @property string $discount 优惠金额
 * @property string $total 总计
 * @property int $status
 * @property int|null $paid_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOuterNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $fillable = ['offer_id', 'coupon_id', 'no', 'outer_no', 'price', 'amount', 'discount', 'total', 'status', 'paid_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}
