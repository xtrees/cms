<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;


class CoinTransaction extends Model
{
    const TYPE_SYSTEM_REDUCE = -2; //购买文章
    const TYPE_CONTENT = -1; //购买文章
    const TYPE_RECHARGE = 1;   //充值
    const TYPE_SYSTEM_INCREASE = 2;   //系统赠送
}
