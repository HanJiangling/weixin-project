<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
     //User模型类对应的数据表
    protected $table = 'role';
    //自动对updated_at 和created_at 做时间的维护 默认的是true
    public $timestamps = false;
}
