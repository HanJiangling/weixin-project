<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class OrdersController extends Controller
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

    //勾选数据入session
    public function accounts(Request $request){
        //清除session数据
        $request->session()->pull('goods');
        $arr=$_GET['arr'];
        $data=array();
        //遍历
        foreach($arr as $key=>$value){
            //获取session
            $cart=session('cart');
            //遍历
            foreach($cart as $k=>$v){
                //判断
                if($value==$v['id']){
                    $data[$k]['num']=$cart[$k]['num'];
                    $data[$k]['id']=$value;
                }
            }
        }

        //把含有勾选数据的id和num存储在session
        $request->session()->push('goods',$data);
        echo json_encode($data);
    }
    //加载结算页
    public function insert(){
        //获取session数据 勾选数据的session=》id和num
        $goods=session('goods');
        $d=[];
        $allprice=0;
        // var_dump($goods);die;
        //遍历
        foreach($goods[0] as $key=>$value){
            //获取数据库的数据
            $info=DB::table("shops")->where("id","=",$value['id'])->first();
            //封装数组
            $temp['num']=$value['num'];//数量
            $temp['name']=$info->name;//名字
            $temp['pic']=$info->pic;//图片
            $temp['price']=$info->price;
            $allprice+=$info->price*$value['num'];
            $d[]=$temp;

        }

        // dd($d);
        // echo "this is jieduanye";
        //获取该用户所有的收货地址
        //获取用户的id
        $user_id=session('user_id');
        $alladdress=DB::table("address")->where("user_id","=",$user_id)->get();
        //获取默认的收货地址
        $defaultaddress=DB::table("address")->where("status","=",1)->first();
        //加载结算页
        return view("Home.Orders.index",['data'=>$d,'allprice'=>$allprice,'alladdress'=>$alladdress,'defaultaddress'=>$defaultaddress]);
    }

    //创建订单
    public function insertorder(Request $request){
        //获取地址id
        //向订单表插入数据
        // dd($request->all());
        $data=$request->except('_token');
        $data['order_num']=time()+rand(1,10000);//订单号
        $data['user_id']=session('user_id');//用户id
        $data['status']=0;//0代表已经下单 但是没有支付  1=》已经支付
        $id=DB::table("orders")->insertGetId($data);
        // echo "ok";
        //在下单的同时 向订单详情插入数据
        if($id){
            $d=[];
            $tot=0;
            //封装下数据
            //获取session
            $goods=session("goods");
            //遍历
            foreach($goods[0] as $key=>$value){
                //获取商品数据
                $shop=DB::table("shops")->where("id","=",$value['id'])->first();
                $temp['num']=$value['num'];
                $temp['goods_id']=$value['id'];
                $temp['name']=$shop->name;
                $temp['pic']=$shop->pic;
                $temp['order_id']=$id;
                $tot+=$shop->price*$value['num'];
                $d[]=$temp;
            }

            //插入数据
            if(DB::table("orders_goods")->insert($d)){
                // echo "订单提交完毕";
                //把订单id存储在session里
                session(['order_id'=>$id]);
                //付款总金额存储在session里
                session(['tot'=>$tot]);
                //把选择收货地址id存储在session里
                session(['address_id'=>$data['address_id']]);
                //调用支付的接口
                pay($data['order_num'],"商品","0.01","商品付款");
            }
        }

    }

    //加载付款成功的页面
    public function returnurl(){
        // echo "ok";
        //获取付款总金额
        $tot=session('tot');
        $address_id=session("address_id");
        $address=DB::table("address")->where("id","=",$address_id)->first();
        $order_id=session("order_id");
        //修改订单状态
        $data['status']=1;
        DB::table("orders")->where("id","=",$order_id)->update($data);
        //加载模板
        return view("Home.Orders.success",['tot'=>$tot,'address'=>$address]);
    }
}
