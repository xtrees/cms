<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

/**
 * XTrees\CMS\Models\Coupon
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $order_id
 * @property int $activity_id
 * @property int $type 优惠券类型
 * @property string $amount 折扣或优惠
 * @property string $start_price 最低入门金额
 * @property string $max_discount 最大优惠金额
 * @property string|null $start_at
 * @property string|null $ended_at
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUserId($value)
 * @mixin \Eloquent
 */
class Coupon extends Model
{
    const STATUS_INVALID = -1;
    const STATUS_VALID = 0;
    const STATUS_FREEZE = 1;
    const STATUS_USED = 2;

    const TYPE_DISCOUNT = 0; //折扣
    const TYPE_REBATE = 1;   //满减


    public function calculate($price)
    {
        $discount = 0;

        if ($this->start_price > $price) {
            return $discount;
        }

        if ($this->type == self::TYPE_DISCOUNT) {
            $discount = $price * $this->amount;
            if ($this->max_discount) {
                $discount = min($discount, $this->max_discount);
            }
        } else {
            $discount = $price - $this->amount;
        }
        //满减
        return max(round($discount, 2), 0);
    }
}
