<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Usersinsert extends FormRequest
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
            // "name"=>"required|regex:/^[\u2E80-\u9FFF]+$/",//党员名字
            'name' => ['required','regex:/[\x7f-\xff]+/'],
            // "sex"=>"required|regex:/^[a-zA-Z\x{4e00}-\x{9fa5}]+$/u",//性别
            'phone' => ['required','regex:/^1[34578]\d{9}$/ims'],
            // "phone"=>"required|regex:/^1[34578]\d{9}$/ims",//电话
            //身份证
            // 'sfz' => ['required','regex:/^[1-9]\d{5}(18|19|20|(3\d))\d{2}((0[1-9])|(1[0-2]))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/'],
            // 'status' => ['required'],
            // "sfz"=>"required|regex:/^[1-9]\d{5}(18|19|20|(3\d))\d{2}((0[1-9])|(1[0-2]))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/"

        ];
    }
    //自定义错误消息
    public function messages(){
        return [

            "name.required"=>"姓名不能为空",
            "name.regex"=>"姓名必须是汉字",
            "phone.required"=>"电话不能为空",
            "phone.regex"=>"电话格式有误",
            // "sfz.required"=>"身份证不能为空",
            // "sfz.regex"=>"身份证格式错误",
            // "status.required"=>"是否通过小程序参会选项必须选择"
        ];
    }
}
