<?php

namespace App\Http\Middleware;

use Closure;

class HomeLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //判断当前有没有前台登录的session信息
        if($request->session()->has('email')){
            //执行下一个请求
            //如果前台登录了,执行下一个请求
            return $next($request);
        }else{
            //直接跳转到前台登录界面  redirect 跳转方法类似于=》php header   /login是路由
            return redirect("/homelogin/create");
        }
    }
}
