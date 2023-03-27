<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;//导入Users表对应的模型类
use App\Http\Requests\AdminUsersinsert;//导入表单校验请求类
use DB;
use Illuminate\Support\Facades\Redis;//导入redis类

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取数据
        // $data=DB::table("yuyue")->get();
        $arts=[];
        //初始化哈希表名和链表的名字
        $listKey="Lists:xz";//链表名字=》存储id
        $hashKey="Hashs:xz";//哈希表名 =》存储公告的数据
        //判断链表里是否有id
        if(Redis::exists($listKey)){
            //获取id集合
            $lists=Redis::lrange($listKey,0,-1);
            //遍历id
            foreach($lists as $k=>$v){
                // if(count()){

                // }
                //根据遍历的id 获取哈希表数据  每获取到一条吧数据添加到数组里 $arts
                $arts[]=Redis::hgetall($hashKey.$v);
            }
        }
        // var_dump($arts);
        //分配数据
        return view("Admin.User.index",['data'=>$arts]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加
        return  view("Admin.User.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersinsert $request)
    {
        //数据插入
        // echo "this is store";
        $data=$request->except(['repassword','_token']);
        //密码加密
        $data['password']=Hash::make($data['password']);
        //默认去添加状态
        $data['status']=0;//0=>未激活 1=》已经激活

        //使用模型类入库
        if(User::create($data)){
            return redirect("/adminuser")->with("success","添加成功");

        }else{
            return back()->with("error","添加失败");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //会员详情的获取
    public function show($id)
    {
        // echo  $id;
        $userinfo=User::find($id)->info;
        // dd($userinfo);
        //分配数据到视图里
        return view("Admin.User.info",['userinfo'=>$userinfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        //获取需要修改的数据
        $data=User::where("id","=",$id)->first();
        //加载模板 分配数据
        return view("Admin.User.edit",['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo $id;
        //获取素有的参数
        // dd($request->all());
        $data=$request->except(['_token','_method']);
        $data['status']=0;
        //执行修改
        if(User::where("id","=",$id)->update($data)){
            return redirect("/adminuser")->with("success","修改成功");
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::where("id","=",$id)->delete()){
            return redirect("/adminuser")->with("success","删除成功");
        }else{
            return redirect("/adminuser")->with("error","删除失败");

        }
    }

    //获取会员收货地址
    public function alladdress($id){
        // echo $id;
        $address=User::find($id)->address;
        // dd($address);
        // dd($address);
        //加载视图 分配数据
        return view("Admin.User.address",['address'=>$address]);

    }
}
