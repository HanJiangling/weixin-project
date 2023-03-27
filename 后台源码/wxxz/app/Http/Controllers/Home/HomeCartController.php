<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminShop;
use DB;
class HomeCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取session数据
        $cart=session("cart");
        $data1=array();
        // dd($cart);
        if(!empty($cart)){
        
            //遍历
            foreach($cart as $key=>$value){
                //获取商品数据
                $info=AdminShop::where("id","=",$value['id'])->first();
                //把商品其他参数写在数组内
                $data['id']=$value['id'];
                $data['name']=$info->name;
                $data['descr']=$info->descr;
                $data['pic']=$info->pic;
                $data['price']=$info->price;
                $data['num']=$value['num'];
                $data1[]=$data;

            }
    }
        // dd($data1);
        //加载购物车界面
        return view("Home.HomeCart.index",['data1'=>$data1]);
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

    //去重方法
    //$id 购买商品的id
    public function checkExists($id){
        //获取购物车的数据
        $goods=session('cart');
        //判断购物车是否为空
        if(empty($goods)) return false;
        //遍历
        foreach($goods as $key=>$value){
            //判断要购买的数据在不在购物车内
            if($value['id']==$id){
                return true;//购买的商品数据在购物车里=》做去重
            }
        }


    }
    public function store(Request $request)
    {
        //获取刚才详情页的数据
        // dd($request->all());
        $data=$request->except('_token');
        if(!$this->checkExists($data['id'])){
             //把购物车内不存在的的商品参数（id num）存储在session数组内
            $request->session()->push('cart',$data);
        }
       
        //跳转到购物车界面
        return redirect("/homecart");
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
        //单个删除
        // echo $id;
        //把商品数据从sesson里移除掉 unset
        //获取session数据
        $data=session("cart");
        //遍历
        foreach($data as $key=>$value){
            //对比
            if($value['id']==$id){
                //删除
                unset($data[$key]);
            }
        }
        //把session数据重新写回去(session初始化)
        session(['cart'=>$data]);
        return redirect("/homecart");
    }

    //全部删除
    public function alldelete(Request $request){
        $request->session()->pull('cart');
        return redirect("/homecart");
    }

    //ajax减操作
    public function cartupdatee(Request $request){
        $id=$request->input("id");
        //获取数据库的数据
        $info=AdminShop::where("id","=",$id)->first();
        // echo $id;
        //服务端session里商品的数量做减操作
        //获取session
        $data=session("cart");
        //遍历
        foreach($data as $key=>$value){
            //判断 做对比
            if($value['id']==$id){
                //该商品的数量减一
                $data[$key]['num']-=1;
                //判断
                if($data[$key]['num']<=1){
                    $data[$key]['num']=1;
                }
                  //重新给session赋值
                session(['cart'=>$data]);
                //封装下数据 返回给客户端
                $data1['num']=$data[$key]['num'];//减以后的数量
                $data1['tot']=$data[$key]['num']*$info->price; 
                //把减一后的数量值返回
                return response()->json($data1);
            }


        }

      
        
    }

    //ajax加操作
    public function cartupdate(Request $request){
        $id=$request->input("id");
        $info=AdminShop::where("id","=",$id)->first();
        // echo $id;
        //获取sesion数据
        $data=session("cart");
        //遍历
        foreach($data as $key=>$value){
            //判断
            if($value['id']==$id){
                //使其数量加一
                $data[$key]['num']+=1;
                //判断
                if($data[$key]['num']>$info->num){
                    $data[$key]['num']=$info->num;
                }
                //session重新赋值
                session(['cart'=>$data]);
                //初始化数据
                $data1['num']=$data[$key]['num'];
                $data1['tot']=$data[$key]['num']*$info->price;
                // echo $data[$key]['num'];
                return response()->json($data1);
            }
        }
    }

    public function tot(Request $request){
        // echo json_encode($_GET['arr']);
        //判断
        if(isset($_GET['arr'])){

        
        //累计的总价格
        $sum=0;
        //累计的选中的数量
        $nums=0;
        //遍历数组
        foreach($_GET['arr'] as $value1){
            //获取session 的数据
            $data=session('cart');
            //遍历
            foreach($data as $key=>$value){
                //判断
                if($value['id']==$value1){
                    //获取单价和数量
                    $num=$data[$key]['num'];
                    //获取数据库数据
                    $info=DB::table("shops")->where("id","=",$value1)->first();
                    //获取价格
                    $price=$info->price;
                    //计算每条数据的总计
                    $tot=$price*$num;
                    //总价格的累加
                    $sum+=$tot;
                    //总计数量的累加
                    $nums+=$num;

                }
            }
        }

        //封装数据
        $data2['nums']=$nums;
        $data2['sum']=$sum;
        return response()->json($data2);
    }else{
        $data2['nums']=0;
        $data2['sum']=0;
        return response()->json($data2);
    }

    }
}
