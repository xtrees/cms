<?php


namespace XTrees\CMS\Http\Controllers\Web;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use XTrees\CMS\Models\Offer;
use XTrees\CMS\Models\User;
use XTrees\CMS\Repositories\WalletRepo;

class WalletController extends WebController
{
    /**
     *
     */
    public function vips()
    {

    }

    /**
     *
     */
    public function coins(WalletRepo $repo, Request $request)
    {
        $user = $request->user();
        $offers = $repo->coinOffers();
        //金币记录
        $transactions = $repo->transaction($user->id);
        return view('cms::user.wallet.coin', compact('offers', 'transactions'));
    }

    /**
     * 订单记录
     */
    public function orders(WalletRepo $repo, Request $request)
    {
        $user = $request->user();
        $orders = $repo->order($user->id);
        return view('cms::user.wallet.order', compact('orders'));
    }


    /**
     *
     * @throws Throwable
     */
    public function createOrder(WalletRepo $repo, Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $ofid = $request->input('offer');
        $cid = $request->input('coupon');
        $amount = intval($request->input('amount', 1));
        $offer = $repo->offer($ofid);
        $coupon = $repo->validCoupon($cid);
        $order = $repo->createOrder($user, $offer, $amount, $coupon);
        //jump to the cashier
        if ($order) {
            return redirect()->route('users.wallet.cashier', ['id' => $order->id]);
        }
        return $this->flashBack("创建订单失败，请稍后重试或联系客服！");
    }

    /**
     * 收银台
     * @return View|RedirectResponse
     */
    public function cashier(WalletRepo $repo, Request $request)
    {
        $oid = $request->input('id');
        $user = $request->user();
        $order = $repo->order($oid);
        if ($order) {
            return $this->flashBack("订单不存在!");
        }


        return view('cms::user.wallet.cashier', compact('user', 'order'));
    }

}
