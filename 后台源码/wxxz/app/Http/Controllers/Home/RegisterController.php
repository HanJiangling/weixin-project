<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use A;//导入自定义类A
use Mail;
use App\Models\User;//导入会员模块的模型类
use Hash;
use Gregwar\Captcha\CaptchaBuilder;//导入验证码类
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    public function sendphone(Request $request){
        $p=$request->input("p");
        // echo $p;
        //调用云之讯短信接口
        sendsphone($p);
    }

    public function checkphone(Request $request){
        //获取输入的校验码
        $code=$request->input("code");
        //做对比 1.校验码是否过期 2.输入的校验码是否为空 3.二者是否一致
        if(isset($_COOKIE['fcode']) && !empty($code)){
            //获取发送的校验码
            $fcode=$request->cookie("fcode");
            if($fcode==$code){
                //返回json响应数据
                return response()->json(['msg'=>'ok']);//二者一致
            }else{
                return response()->json(['msg'=>'error']);//二者不一致

            }
        }elseif(empty($code)){
                return response()->json(['msg'=>'empty']);//输入的校验码为空

        }else{
                return response()->json(['msg'=>'timeout']);//输入的校验码已经过期

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载注册界面
        return view("Home.Register.register");
    }

    //校验码测试
    public function img(){
        //生成校验码代码
        ob_clean();//清除操作 清除一些特殊的字符
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session方便做对比
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        //在浏览器里输出校验码图片
        $builder->output();
        // die;//希望校验码在输出的时候 不受其他代码影响
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //需要调用的发送视图邮件
    public function sendMails($email,$id){
        //在匿名函数的内部引入匿名函数外部的变量，不能直接引入,可以使用use 引入
        Mail::send("Home.Register.jihuo",["id"=>$id],function($message)use($email){
            $message->to($email);//$email 注册的邮箱号
            $message->subject("激活用户");
        });

        return true;
    }
    public function store(Request $request)
    {
        //获取参数
        // $data=$request->all();
        // dd($data);
        $data=$request->except(['code','_token','repassword']);
        //密码加密
        $data['password']=Hash::make($data['password']);
        // dd($data);
        $data['username']="userddd".rand(1,10000);
        //状态
        $data['status']=0;//0代表未激活
        // dd($data);
        //对比输入的校验码是否和系统的校验码一致
        //获取输入校验码
        $code=$request->input("code");
        //获取系统的校验码=》session里
        $vcode=session('vcode');
        // echo $code.":".$vcode;die;
        if($code==$vcode){

        //入库
        $data1=User::create($data);
            //获取插入数据的id
            $id=$data1->id;
            if($id){
                // echo "注册ok";
                //发送邮件激活用户邮件
                $res=$this->sendMails($data['email'],$id);
                if($res){
                    echo "激活用户的邮件已经发送,请登录qq邮箱激活";
                }
            }

        }else{
            return back()->with("error","校验码输入有误");
        }
    }

   //需要单击激活的方法
    public function jihuo(Request $request){
        // echo "1111";
        //获取参数
        $id=$request->input("id");
        //封装下需要修改的数据
        $data['status']=1;//1代表已经激活
        if(User::where("id","=",$id)->update($data)){
            echo "用户已经激活,请去登录";
        }
        // echo $id;
        //数据的修改  status=>0未激活-》1激活
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

    //测试邮件发送的方法
    public function send(){
        // echo "111";
        //this is email ceshi发送原始字符串  $message消息生成器(里面有很多的方法 to subject)
        Mail::raw('this is email ceshi',function($message){
            //发送给谁
            $message->to("987985143@qq.com");
            //发送的主题
            $message->subject("email ceshi");
        });
    }

    //发送视图邮件
    public function sendview(){
        Mail::send("Home.Register.view1",["id"=>100],function($message){
            // $message->to("987985143@qq.com");
            $message->to("guocaijun506@163.com");

            $message->subject("测试邮件视图发送22");
        });
    }


    //校验手机号
    public function checkphones(Request $request){
        $p=$request->input("p");
        // echo $p;
        //输入的手机号和数据库的手机号做对比
        $phone=User::pluck("phone");
        // echo "<pre>";
        // var_dump($phone);
        $arr=array();
        //把获取到的数据转换为数组
        foreach($phone as $key=>$v){
            $arr[$key]=$v;
        }
        //  echo "<pre>";
        // var_dump($arr);
        if(in_array($p,$arr)){
            return response()->json(['msg'=>'ok']);//手机号无法注册
        }else{
            return response()->json(['msg'=>'error']);//手机号可以注册
        }
    }

    public function registerphone(){
        echo "ok";
        //直接到users数据表入库
    }
}
