<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class AddressController extends Controller
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

    //获取城市级联的数据
    public function address(Request $request){
        //获取upid
        $upid=$request->input("upid");
        //获取数据
        $address=DB::table("district")->where("upid","=",$upid)->get();
        echo json_encode($address);
    }

    //收货地址的添加
    public function insert(Request $request){
        //获取登录用户的id
        $user_id=session('user_id');
        // dd($request->all());
        $data=$request->except('_token');
        $data['user_id']=$user_id;
        //处理详细收货地址
        $data['address']=$data['address'].$data['adds'];
        // dd($data);
        //开始入库
        if(DB::table("address")->insert($data)){
            // echo 1;
            //跳转到结算页
            return redirect("/homeorder/insert");
        }
    }

    public function chooseaddress(Request $request){
        $address_id=$request->input("address_id");
        // echo $address_id;
        //获取选中地址数据
        $address=DB::table("address")->where("id","=",$address_id)->first();
        return response()->json($address);
    }
}
