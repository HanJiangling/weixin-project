<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUsersinsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //授权方法
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            //对表单的用户名参数做规则设置 required 输入的数据不能为空
            //regex 正则规则用户名必须是4-16位任意的数字字母下划线
            //unique 数据唯一规则
            "username"=>"required|regex:/\w{4,16}/|unique:users",
            "password"=>"required|regex:/\w{6,16}/",
            //same 指定的字段必须和其他字段值一值
            "repassword"=>"required|regex:/\w{6,16}/|same:password",
            //email 必须符合邮箱格式
            "email"=>"required|email|unique:users",
            "phone"=>"required|regex:/\d{11}/|unique:users",

        ];
    }

    //自定义错误消息
    public function messages(){
        return [

            "username.required"=>"用户名不能为空",
            "username.regex"=>"用户名必须是4-16任意的数字字母下划线",
            "username.unique"=>"用户名重复",
            "password.required"=>"密码不能为空",
            "password.regex"=>"密码必须是6-16任意的数字字母下划线",
            "repassword.required"=>"确认密码不能为空",
            "repassword.regex"=>"重复密码必须是6-16任意的数字字母下划线",
            "repassword.same"=>"两次密码不一致",
            "email.required"=>"邮箱不能为空",
            "email.email"=>"邮箱格式不对",
            "email.unique"=>"邮箱名重复",
            "phone.required"=>"电话不能为空",
            "phone.regex"=>"电话格式有误",
            "phone.unique"=>"电话重复",






        ];
    }
}
