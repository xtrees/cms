<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['no', 'trade_no', 'price'];
}
