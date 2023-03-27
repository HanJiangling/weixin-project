<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUserModel;
use Hash;
use DB;
class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        //销毁session
        $request->session()->pull("islogin");
        return redirect("/adminlogin/create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //登录模板加载
        return view("Admin.AdminLogin.login");
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
        //把接收到的名字和密码  和admin_users 做校验
        //获取name
        $name=$request->input("name");
        //获取输入的密码
        $password=$request->input("password");
        //查询数据库
        $info=AdminUserModel::where("name","=",$name)->where("password","=",$password)->first();
        //获取加密的密码
        if($info){
                //把登录的用户名存储在session里
                session(['islogin'=>$name]);
                //进入到后台首页
                return redirect("/admin")->with("success","登录成功");
        }else{
            // echo "管理员error";
            return back()->with('error',"管理员名字或者密码有误");
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
}
