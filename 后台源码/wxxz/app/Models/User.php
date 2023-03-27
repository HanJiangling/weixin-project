<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //User模型类对应的数据表
    protected $table = 'users';
    //自动对updated_at 和created_at 做时间的维护 默认的是true
    public $timestamps = true;
    //批量赋值属性 (用来声明需要添加的数据的字段,必须要声明)
    protected $fillable = ['username','password','email','phone','status'];

    //修改器的方法把users数据表里的status字段值做转换
    //get获取   Status处理的字段名字 而且第一个字母必须大写 
    public function getStatusAttribute($value){
    	//处理status字段的状态
    	$status=[0=>"未激活",1=>"已激活",2=>"禁用"];
    	//返回处理后的数据结果
    	return $status[$value];
    }

    //会员和会员详情关联
    public function info(){
    	//'App\Models\Userinfo' 需要关联的模型类   users_id 关联条件
    	return $this->hasOne('App\Models\Userinfo','users_id');
    }

    //获取会员模块下所有的收货地址
    public function address(){
    	return $this->hasMany('App\Models\Useraddress','user_id');
    }
}
