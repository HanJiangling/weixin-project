<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUserModel;
use Hash;
use App\Models\RoleModel;
use DB;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取管理员
        $data=AdminUserModel::get();
        //获取当前用户角色
        $role=DB::table("user_role")->where("rid","=",1)->first();
        return view("Admin.AdminUser.index",['data'=>$data,'role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载模板
        return view("Admin.AdminUser.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->except('_token');
        //密码的加密
        $data['password']=Hash::make($data['password']);
        // dd($data);
        if(AdminUserModel::create($data)){
            // echo 1;
            return redirect("/adminuserss")->with("success","添加ok");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function del(Request $request){
        //获取id
        $id=$request->input("id");
        // echo $id;
        //做数据删除
        if(AdminUserModel::where("id","=",$id)->delete()){
            //返回json格式数据
            return response()->json(['msg'=>'ok']);
        }else{
            return response()->json(['msg'=>'error']);

        }
    }

    //分配角色
    public function role($id){
        // echo $id;
        //获取当前管理员的信息
        $user=AdminUserModel::where("id","=",$id)->first();
        //获取所有的角色
        $role=RoleModel::get();
        //获取当前用户已有的角色信息
        $data=DB::table("user_role")->where("uid","=",$id)->get();
        //判断

        //用户以前有角色
        if(count($data)){
            //遍历
            foreach($data as $v){
                $rids[]=$v->rid;
            }

            //加载模板
            return view("Admin.AdminUser.role",['user'=>$user,'role'=>$role,'rids'=>$rids]);
        }else{
            //当前用户以前没有角色
            return view("Admin.AdminUser.role",['user'=>$user,'role'=>$role,'rids'=>array()]);

        }
        
    }

    //保存角色
    public function saverole(Request $request){
        // echo 1;
        //向user_role 插入数据 uid  rid
        //获取uid
        $uid=$request->input("uid");
        // echo $uid;
        //获取分配的角色id数组
        $rids=$_POST['rids'];
        // var_dump($rids);
        //把当前用户已有的角色干掉
        DB::table("user_role")->where("uid","=",$uid)->delete();
        //遍历
        foreach($rids as $key=>$v){
            //封装要插入的数据
            $data['uid']=$uid;
            $data['rid']=$v;
            DB::table("user_role")->insert($data);
        }
        return redirect("/adminuserss")->with("success","角色分配成功");
    }
}
