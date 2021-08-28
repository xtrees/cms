<?php


namespace XTrees\CMS\Repositories;


use XTrees\CMS\Models\Offer;

class WalletRepo
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function coinOffers()
    {
        return Offer::query()
            ->where('type', Offer::COIN)
            ->where('display', true)
            ->orderBy('sort')
            ->get();
    }
}
