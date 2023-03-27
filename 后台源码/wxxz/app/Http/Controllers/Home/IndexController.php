<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\AdminShop;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //无限分类递归的核心代码
    public static function getcatesBypid($pid){
        $cate=DB::table("cates")->where("pid","=",$pid)->get();
        $data=[];
        // 遍历
        foreach($cate as $key=>$value){
             //获取子类信息
            $value->suv=self::getcatesBypid($value->id);
            $data[]=$value;
        }
       
        return $data;
    } 
    public function index()
    {

        //获取当前顶级分类下所有的子类信息(无限分类递归)
        $cate=self::getcatesBypid(0);
        //获取顶级分类的数据
        $cates=DB::table("cates")->where("pid","=",0)->get();
        foreach($cates as $row){
        //获取当前顶级分类下的所有商品数据
        //1.类别表和商品表做关联
        //2.加条件(顶级分类)
        $shop[]=DB::table("shops")->join("cates","shops.cate_id","=","cates.id")->select("cates.name as cname","cates.id as cid","shops.id as sid","shops.name as sname","shops.pic","shops.descr","shops.num","shops.price")->where("shops.cate_id","=",$row->id)->get();
        // dd($shop);
        }
        // echo "<pre>";
        // var_dump($shop);die;
        //加载前台首页
        return  view("Home.Index.index",['cate'=>$cate,"shop"=>$shop]);
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
    //加载详情页方法
    public function show($id)
    {
        // echo "详情页id为".$id;
        //获取商品数据
        $shop=AdminShop::where("id","=",$id)->first();
        //加载详情界面
        return view("Home.Index.homeinfo",['shop'=>$shop]);
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

//顶级分类
// [
//     'id'=>10,
//     'name'=>"衣服",
//     "pid"=>0,
//     "path"=>0,
//     "suv"=>[
//                 //一级分类信息
//                 [
//                     'id'=>11,
//                     'name'=>'男装',
//                     'pid'=>10,
//                     "suv"=>[
//                                 //二级分类
//                                     [
//                                         'id'=>12,
//                                         'name'=>'安踏男装',
//                                         'pid'=>11
//                                     ],
//                                     [
//                                         'id'=>13,
//                                         'name'=>'李宁男装',
//                                         'pid'=>11
//                                     ]
//                             ]
//                 ]
//             ]
// ]
