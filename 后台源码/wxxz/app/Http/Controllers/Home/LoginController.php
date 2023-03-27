<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Mail;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模板
        return view("Home.Login.login");
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
        //获取email
        $email=$request->input("email");
        $password=$request->input("password");
        //校验email
        $info=User::where("email","=",$email)->first();
        // dd($info);
        if($info){
            // echo "ok";
            //密码校验
            if(Hash::check($password,$info->password)){
                // echo "ok";
                //看用户是否是激活的状态
                if($info->status=="已激活"){
                    //设置session
                    //把登录的邮箱值存储咋session里
                    session(['email'=>$email]);
                    //把登录用户的id存储在session里

                    session(['user_id'=>$info->id]);

                    // echo "这是我的前台";
                    return redirect("/homeindex");
                }else{
                    return back()->with("error","此用户还没有激活");
                }
            }else{
                return back()->with("error","密码有误");
            }

        }else{
            return back()->with("error","邮箱名不正确");
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

    //加载密码找回的模板
    public function forget(){
        return view("Home.Login.forget");
    }


    //需要调用的发送视图邮件
    public function sendMails($email,$id){
        //在匿名函数的内部引入匿名函数外部的变量，不能直接引入,可以使用use 引入
        Mail::send("Home.Login.reset",["id"=>$id],function($message)use($email){
            $message->to($email);//$email 注册的邮箱号
            $message->subject("激活用户");
        });

        return true;
    }

    //加载密码找回的模板
    public function doforget(Request $request){
        // dd($request->all());
        //获取email
        $email=$request->input("email");
        //获取数据
        $data=User::where("email","=",$email)->first();
        $res=$this->sendMails($email,$data->id);
        if($res){
            echo "重置密码的邮件已经发送,请登录邮箱重置密码";
        }

    }

    public function reset(Request $request){
        $id=$request->input("id");
        // echo $id;
        //做密码重置
        //加载重置密码的模板
        return view("Home.Login.reset1",['id'=>$id]);
    }

    //重置密码
    public function doreset(Request $request){
        $id=$request->input("id");
        $data['password']=Hash::make($request->input("password"));
        if(User::where("id","=",$id)->update($data)){
            return redirect("/homelogin/create");
        }
    }

    //退出
    public function logout(Request $request){
        $request->session()->pull('email');
        //跳转到登录界面
        return redirect("/homelogin/create");
    }   
}
