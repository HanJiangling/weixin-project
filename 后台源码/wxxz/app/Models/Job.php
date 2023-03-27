<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //User模型类对应的数据表
    protected $table = 'stu';
    //自动对updated_at 和created_at 做时间的维护 默认的是true
    public $timestamps = false;
    //批量赋值属性 (用来声明需要添加的数据的字段,必须要声明)
    protected $fillable = ['name','phone','password'];

}
