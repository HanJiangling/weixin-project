<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;//引入Hash的加密类
use App\Http\Requests\Usersinsert;//导入表单校验请求类
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
      //获取用户数据
      $vv=DB::table("stu")->paginate(3);
      return view("Admin.Users.index",['users'=>$vv]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载用户的添加界面
        return view("Admin.Users.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Usersinsert $request)
    {
        $data=$request->except(['_token']);
        // dd($data);
        $data1['name']=$data['name'];
        $data1['phone']=$data['phone'];
        $data1['password']="qqgk123456";

        //插入数据
        $res=DB::table("stu")->insert($data1);
        if($res){
          return redirect("/users")->with("success","添加成功");

        }else{
          return back()->with("success","添加失败");
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
        //获取需要修改的数据
        $vv=DB::table("stu")->where("id","=",$id)->first();
        //加载模板
        return view("Admin.Users.edit",['user'=>$vv]);



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
        $data=$request->except(['_token','_method']);
        $data1['name']=$data['name'];
        $data1['phone']=$data['phone'];
        $res=DB::table("stu")->where("id","=",$id)->update($data1);
        if($res){
          return redirect("/users")->with("success","修改成功");
        }else{
          return back()->with("error","修改失败");
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
        
        $res=DB::table("stu")->where("id","=",$id)->delete();
        if($res){
          return redirect("/users")->with("success","删除成功");
        }else{
          return redirect("/users")->with("success","删除失败");

        }
        
            
    }
}
