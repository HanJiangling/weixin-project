<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    //与模型类对应的数据表
    protected $table="orders";
    //是否自动维护时间戳
    public $timestamp=false;
    //修改器 对数据表的数据自动的做转换
    public function getStatusAttribute($value){
    	$status=[0=>'已下单未支付',1=>"已支付",2=>"已发货",3=>"已收货"];
    	return $status[$value];
    }

    //获取当前订单下所有的详情
    public function orderinfo(){
    	return $this->hasMany("App\Models\OrdersGoodsModel","order_id");
    }

}
