<?php


namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Model;

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
