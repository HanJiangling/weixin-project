<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersGoodsModel extends Model
{
    //与模型类对应的数据表
    protected $table="orders_goods";
    //是否自动维护时间戳
    public $timestamp=false;
}
