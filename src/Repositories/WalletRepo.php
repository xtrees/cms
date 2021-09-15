<?php


namespace XTrees\CMS\Repositories;


use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Log;
use Throwable;
use XTrees\CMS\Models\CoinTransaction;
use XTrees\CMS\Models\Coupon;
use XTrees\CMS\Models\Offer;
use XTrees\CMS\Models\Order;
use XTrees\CMS\Models\User;

class WalletRepo
{
    /**
     * @return Collection
     */
    public function coinOffers(): Collection
    {
        return Offer::query()
            ->where('type', Offer::COIN)
            ->where('display', true)
            ->orderBy('sort')
            ->get();
    }

    /**
     * @return Collection
     */
    public function vipOffers(): Collection
    {
        return Offer::query()
            ->where('type', Offer::VIP)
            ->where('display', true)
            ->orderBy('sort')
            ->get();
    }

    /**
     * @param $id
     * @return Model|null|Offer
     */
    public function offer($id): ?Offer
    {
        return Offer::query()
            ->where('display', true)
            ->find($id);
    }

    /**
     * 查询可用状态 优惠券
     * @param $cid
     * @param null $uid
     * @return Coupon|null
     */
    public function validCoupon($cid, $uid = null): ?Coupon
    {
        if (is_null($cid)) return null;
        return Coupon::query()
            ->when('user_id', function ($query) use ($uid) {
                return $query->where('user_id', $uid);
            })
            ->where('status', Coupon::STATUS_VALID)
            ->find($cid);
    }

    /**
     * @param User $user
     * @param Offer $offer
     * @param int $amount
     * @param Coupon|null $coupon
     * @return Order|null
     * @throws Throwable
     */
    public function createOrder(User $user, Offer $offer, int $amount = 1, Coupon $coupon = null): ?Order
    {
        $order = new Order();
        $order->user()->associate($user);
        $total = $offer->price * $amount;
        $discount = 0;
        if ($coupon) {
            $order->coupon()->associate($coupon);
            $discount = $total - $coupon->calculate($total);
        }
        $order->fill([
            'offer_id' => $offer->id,
            'no' => self::no(),
            'price' => $offer->price,
            'amount' => $amount,
            'discount' => $discount,
            'total' => $total - $discount,
        ]);
        try {
            DB::beginTransaction();
            if ($order->save() && $coupon) {
                $coupon->update([
                    'status' => Coupon::STATUS_FREEZE,
                ]);
            }
            DB::commit();
            return $order;
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('CreateOrder ' . $e->getMessage(), $e->getTrace());
        }
        return null;
    }

    /**
     * @param $id
     * @return Order|null
     */
    public function order($id): ?Order
    {
        return Order::query()->find($id);
    }

    public function orders($uid, $perPage = 30): LengthAwarePaginator
    {
        return Order::query()->where('user_id', $uid)->orderBy('id', 'DESC')->paginate($perPage);
    }


    public function transaction($uid, $perPage = 30): LengthAwarePaginator
    {
        return CoinTransaction::query()
            ->where('user_id', $uid)
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public static function no(): string
    {
        //20210830165119200161D
        $prefix = date('YmdHis') . mt_rand(100000, 999999);
        $hash = strtoupper(substr(md5($prefix), 0, 1));
        return $prefix . $hash;
    }
}
