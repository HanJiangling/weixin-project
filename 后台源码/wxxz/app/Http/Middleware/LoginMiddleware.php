<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //操作的方法 =>做过滤=>做判断 $request发的请求   $next执行下一个请求=>如果后台登录了,执行下一个请求
    public function handle($request, Closure $next)
    {
        //判断当前有没有后台登录的session信息
        if($request->session()->has('islogin')){
            //4.获取访问模块的控制器和方法  和权限列表做对比
            //获取权限列表
            $nodelist=session('nodelist');
            //获取访问模块控制器和方法名
            //获取访问模块的控制器和方法
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            $controllerName=$func[0];
            $actionName=$func[1];
            // echo $controllerName.':'.$actionName;
            //对比
            // if(empty($nodelist[$controllerName]) ||!in_array($actionName,$nodelist[$controllerName])){
            //     //提示
            //     return redirect("/admin")->with("error","您没有权限访问该模块,请联系超级管理员");
            // }

            //执行下一个请求
            //如果后台登录了,执行下一个请求
            return $next($request);
        }else{
            //直接跳转到登录界面  redirect 跳转方法类似于=》php header   /login是路由
            return redirect("/adminlogin/create");
        }

        
    }
}
