<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//开放接口
//党员登录接口
Route::get("/yh/{phone}-{password}","Admin\ApiController@yh");
//预约座位
Route::get("/yuyue/{type}-{zw}-{starttime}-{endtime}-{username}-{phone}-{cz}","Admin\ApiController@yuyue");
//获取预约数据
Route::get("/yuyues/{phone}","Admin\ApiController@yuyues");
//取消预约
Route::get("/cacelyuyue/{id}","Admin\ApiController@cacelyuyue");
//学员密码修改
Route::get("/resetmm/{phone}-{mm}","Admin\ApiController@resetmm");
//获取所有已经选择座位
Route::get("/getallzw","Admin\ApiController@getallzw");
//后台登录
Route::resource("/adminlogin","Admin\AdminLoginController");

Route::group(['middleware'=>'adminlogin'],function(){
//路由搭建后台
Route::resource("/admin","Admin\AdminController");
//管理员密码修改控制器
Route::resource("/admins","Admin\AdminsController");
//管理员密码修改
Route::get("/adminreset1/{name}","Admin\AdminsController@resetmm");
//后台学员模块   
Route::resource("/users","Admin\UsersController");
//批量导入
Route::resource("/userss","Admin\UserssController");
//后台预约管理模块
Route::resource("/adminuser","Admin\UserController");
// Route::get("/alladdress/{id}","Admin\UserController@alladdress");

//后台无限分类
Route::resource("/admincate","Admin\CateController");

//后台管理员模块
Route::resource("/adminuserss","Admin\AdminUserController");
//后台管理员Ajax删除
Route::get("/adminuserssdel","Admin\AdminUserController@del");
});
