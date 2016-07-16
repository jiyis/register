<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/1
 * Time: 23:37
 * Desc：
 */

namespace App\Http\Requests\Index;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:20|alpha_dash',
            //'email' => 'required|email',
            'password' => 'sometimes|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名称不能为空',
            'name.alpha_dash' => '用户仅允许字母、数字、破折号（-）以及底线（_）',
            'name.max' => '用户名称最多20个字符',
            //'email.required' => '邮箱不能为空',
            //'email.email' => '邮箱非法',
            'password.max' => '密码最多20个字符'
        ];
    }
}