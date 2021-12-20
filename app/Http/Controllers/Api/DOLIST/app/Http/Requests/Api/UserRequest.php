<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        
    return [
        'name' => 'required| max:45|unique:users',
        'password' => 'required| max:100|min:6',
        'email'=>'required|min:5'
    ];
            
    }

    // public function messages()
    // {
    //     return [
    //         'id.required'=>'用户ID必须填写',
    //         'id.exists'=>'用户不存在',
    //         'name.unique' => '用户名已经存在',
    //         'name.required' => '用户名不能为空',
    //         'name.max' => '用户名最大长度为12个字符',
    //         'password.required' => '密码不能为空',
    //         'password.max' => '密码长度不能超过16个字符',
    //         'password.min' => '密码长度不能小于6个字符'
    //     ];
    // }

}
