<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticlesModel;
use Config;
use Intervention\Image\ImageManager;//导入图片处理类
use App\Services\OSS;//导入OSS类
use Illuminate\Support\Facades\Redis;//导入redis类
class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arts=[];
        //初始化哈希表名和链表的名字
        $listKey="Lists:phper";//链表名字=》存储id
        $hashKey="Hashs:phper";//哈希表名 =》存储公告的数据
        //判断链表里是否有id
        if(Redis::exists($listKey)){
            //获取id集合
            $lists=Redis::lrange($listKey,0,-1);
            //遍历id
            foreach($lists as $k=>$v){
                //根据遍历的id 获取哈希表数据  每获取到一条吧数据添加到数组里 $arts
                $arts[]=Redis::hgetall($hashKey.$v);
            }
        }else{
            //缓存服务器没有数据 获取数据库数据=》给缓存服务器一份
            //获取公告列表数据  toArray() 转换数组的意思
            $arts=ArticlesModel::get()->toArray();
            //把数据库处理过的数据给缓存服务器一份
            // id  editor descr  pic
            // 22  111    111    1.jpg
            // 23  222    222    2.jpg
            // 24  333    333    3.jpg
            foreach($arts as $key=>$value){
                //把id存储在redis 的链表集合里 $listKey
                Redis::rpush($listKey,$value['id']);
                //把数据放置在哈希表里
                Redis::hmset($hashKey.$value['id'],$value);
            }
        }
        
        //加载模板
        return view("Admin.Articles.index",['arts'=>$arts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("Admin.Articles.add");
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
        //1.判断是否有文件上传
        // if($request->hasFile("pic")){
        //     //初始化名字
        //     $name=time()+rand(1,10000);
        //     //获取后缀
        //     $ext=$request->file("pic")->getClientOriginalExtension();
        //     //移动
        //     $request->file("pic")->move(Config::get('app.app_upload')."/",$name.".".$ext);
        //     //图片裁剪和图片水印
        //     //实例化图片处理类
        //     $manager = new ImageManager();
        //     // 图片裁剪
        //     $manager->make(Config::get("app.app_upload")."/".$name.".".$ext)->resize(100,100)->save(Config::get("app.app_upload")."/"."r_".$name.".".$ext);
        //     //图片水印
        //     // $manager->make(Config::get("app.app_upload")."/".$name.".".$ext)->insert("./upload/logo.jpg","'bottom-right",100,200)->save(Config::get("app.app_upload")."/"."r_".$name.".".$ext);
        //     //获取参数
        //     $data=$request->except('_token');
        //     // dd($data);
        //     $data['pic']=trim(Config::get("app.app_upload")."/"."r_".$name.".".$ext,".");
        //     // dd($data);
        //     if(ArticlesModel::create($data)){
        //         return redirect("/adminarticles")->with("success","公告添加成功");
        //     }
        // }

        //2.阿里oss做图片上传(推荐做法)
        if($request->hasFile("pic")){
            //获取上传资源
            $file=$request->file("pic");
            //获取上传的零时资源目录
            $filepath=$file->getRealPath();
            //初始化名字
            $name=time()+rand(1,10000);
            //获取后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            //初始化名字=》当做oss上传以后的文件名字
            $newfile=$name.".".$ext;
            //使用oss
            OSS::upload($newfile,$filepath);
            $data=$request->except('_token');
            $data['pic']="https://lampphper.oss-cn-beijing.aliyuncs.com/".$newfile;
            $data1=ArticlesModel::create($data);
            //获取id
            $id=$data1->id;
            $data['id']=$id;
            // //把添加的数据加入到redis缓存服务器下
            // //初始化哈希表名和链表的名字
             $listKey="Lists:phper";//链表名字=》存储id
             $hashKey="Hashs:phper";//哈希表名 =》存储公告的数据
            // //把id添加到链表集合里
            Redis::rpush($listKey,$id);
            // //把数据加入到哈希表里
            Redis::hmset($hashKey.$id,$data);
            //入库
            if($id){
                return redirect("/adminarticles")->with("success","公告添加成功");
            }

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
        $id=$request->input("id");
        if($id==""){
            return response()->json(['msg'=>'请至少选中一条数据']);
        }
        // echo json_encode($id);
        //遍历
        foreach($id as $key=>$value){
            //做阿里oss的删除
            //获取需要删除的数据
            $info=ArticlesModel::where("id","=",$value)->first();
            //获取pic
            $pic=$info->pic;
            // echo $pic;
            // https://lampphper.oss-cn-beijing.aliyuncs.com/1591412803.jpg
            $ress=str_replace("https://lampphper.oss-cn-beijing.aliyuncs.com/","",$pic);
            // echo $ress;
            OSS::deleteObject($ress);
            //初始化哈希表名和链表的名字
            $listKey="Lists:phper";//链表名字=》存储id
            $hashKey="Hashs:phper";//哈希表名 =》存储公告的数据

            //干掉缓存服务器的数据
            //干掉链表里的id
            Redis::lrem($listKey,0,$value);
            //干掉哈希表里的数据 
            Redis::del($hashKey.$value);
            
            //使用图片组件传的图片做删除 unlink
            //获取需要删除数据
            // $info1=ArticlesModel::where("id","=",$value)->first();
            // //获取pic
            // $pic=$info1->pic;//裁剪以后的图片路径 /upload/2020-06-06/r_1591409598.jpg=>/upload/2020-06-06/1591409598.jpg=>裁剪以前图片路径
            // //获取裁剪以前的路径
            // $bigpic=str_replace("r_","",$pic);
            // // echo $bigpic;

            // //裁剪后的图片变为相对路径
            // $pics=".".$pic;
            //  //裁剪前的图片变为相对路径
            // $bigpics=".".$bigpic;
            // unlink($pics);
            // unlink($bigpics);
            // echo $pic;
            ArticlesModel::where("id","=",$value)->delete();
        }

        return response()->json(['msg'=>'ok']);
    }

    //测试redis
    public function redis(){
        //之前研究过的redis数据类型里面所有命令和方法都可以在laravel里使用
        // Redis::set("aa1","abc");
        //获取字符串数据
        // echo  Redis::get("aa1");
        //哈希方法  
        // Redis::hset("user001","name","zihai");
        //获取
        // $data=Redis::hgetall("user001");
        // var_dump($data);

        //删除数据
        // Redis::del("user001");

        //链表
        // Redis::lpush("list2","aaaa");
        //获取链表的数据
        $data=Redis::lrange("list2",0,-1);
        var_dump($data);
        //删除
        // Redis::lrem("list2",0,"aaaa");

    }
}
