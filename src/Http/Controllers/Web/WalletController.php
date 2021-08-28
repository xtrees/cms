<?php


namespace XTrees\CMS\Http\Controllers\Web;

use XTrees\CMS\Models\Offer;
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
    public function coins(WalletRepo $repo)
    {
        $offers = $repo->coinOffers();
        return view('cms::user.wallet.coin', compact('offers'));
    }

    /**
     *
     */
    public function createVIPOrder()
    {

    }

    /**
     *
     */
    public function createCoinOrder()
    {

    }

    public function pay()
    {

    }

    public function orders()
    {

    }
}
