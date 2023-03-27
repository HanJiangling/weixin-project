<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;//导入redis类
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //预约座位
    public function yuyue($type,$zw,$starttime,$endtime,$username,$phone,$cz){
        $data['type']=$type;
        $data['zw']=$zw;
        $data['starttime']=$starttime;
        $data['endtime']=$endtime;
        $data['username']=$username;
        $data['phone']=$phone;
        $data['cz']=$cz;
        $id=rand(1,10000);
        $data['id']=$id;
            // //把添加的数据加入到redis缓存服务器下
            // //初始化哈希表名和链表的名字
             $listKey="Lists:xz";//链表名字=》存储id
             $hashKey="Hashs:xz";//哈希表名 =》存储公告的数据
            // //把id添加到链表集合里
            $res=Redis::rpush($listKey,$id);
            // //把数据加入到哈希表里
            $ress=Redis::hmset($hashKey.$id,$data);
            //设置过期时间
            Redis::expire($hashKey.$id,$data['cz']);
            // Redis::expire($listKey,$data['cz']);

        if($res && $ress){
            $data1=array("msg"=>"ok","code"=>0);
            echo json_encode($data1);
        }

    }
    //获取预约数据
    public function yuyues($phone){
        $arts=[];
        $a=[];
        //初始化哈希表名和链表的名字
        $listKey="Lists:xz";//链表名字=》存储id
        $hashKey="Hashs:xz";//哈希表名 =》存储公告的数据
        //判断链表里是否有id
        if(Redis::exists($listKey)){
            //获取id集合
            $lists=Redis::lrange($listKey,0,-1);
            //遍历id
            foreach($lists as $k=>$v){
                //根据遍历的id 获取哈希表数据  每获取到一条吧数据添加到数组里 $arts
                $arts[]=Redis::hgetall($hashKey.$v);
            }
        }
        //遍历数据
        if(count($arts)){
            //遍历arts  获取zw
            foreach($arts as $key=>$value){
                if(count($value)){
                                    //判断
                if($value['phone']==$phone){
                    $a[]=$value;
                }
                }

            }
        }
        echo json_encode($a);
        // echo json_encode($arts);
    }

    //取消预约
    public function cacelyuyue($id){
        // $res=DB::table("yuyue")->where("id","=",$id)->delete();
        //初始化哈希表名和链表的名字
            $listKey="Lists:xz";//链表名字=》存储id
            $hashKey="Hashs:xz";//哈希表名 =》存储公告的数据

            //干掉缓存服务器的数据
            //干掉链表里的id
            $res=Redis::lrem($listKey,0,$id);
            //干掉哈希表里的数据 
            $ress=Redis::del($hashKey.$id);
        if($res && $ress){
            $data=array("msg"=>"ok");
            echo json_encode($data);
        }
    }
    //学员登录
    public function yh($phone,$password){
        //校验电话和密码
        $res=DB::table("stu")->where("phone","=",$phone)->first();
        if($res){
            if($password==$res->password){
                $data=array("msg"=>"ok","name"=>$res->name,"phone"=>$res->phone);//登录成功
                echo json_encode($data);
            }else{
                $data=array("msg"=>"error1");//密码错误
                echo json_encode($data);
            }
            
        }else{
            $data=array("msg"=>"error");//用户名错误
            echo json_encode($data);
        }
    }
    //学员密码修改
    public function resetmm($phone,$mm){
        //获取数据
        $res=DB::table("stu")->where("phone","=",$phone)->first();
        $data['password']=$mm;
        $ress=DB::table("stu")->where("id","=",$res->id)->update($data);
        if($ress){
            $data1=array("msg"=>"ok","code"=>0);
            echo json_encode($data1);
        }
    }

    //获取所有的已选座位
    public function getallzw(){
        // $res=DB::table("yuyue")->pluck("zw");
        $arts=[];
        $aa=[];

        //初始化哈希表名和链表的名字
        $listKey="Lists:xz";//链表名字=》存储id
        $hashKey="Hashs:xz";//哈希表名 =》存储公告的数据
        //判断链表里是否有id
        if(Redis::exists($listKey)){
            //获取id集合
            $lists=Redis::lrange($listKey,0,-1);
            //遍历id
            foreach($lists as $k=>$v){
                //根据遍历的id 获取哈希表数据  每获取到一条吧数据添加到数组里 $arts
                $arts[]=Redis::hgetall($hashKey.$v);
            }
        }
        // var_dump(count($arts));
        // var_dump($arts);
        if(count($arts)){

        
        //遍历arts  获取zw
        foreach($arts as $key=>$value){
            if(count($value)){
                 $aa[]=$value['zw'];
            }
           
        }
        echo json_encode($aa);
        }
    }
    //redis测试
    
    public function index()
    {
        //加载后台首页
        return view("Admin.Admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
