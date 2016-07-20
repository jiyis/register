<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/30
 * Time: 17:54
 */

namespace App\Http\Requests\Index;


use App\Http\Requests\Request;
use App\Models\Register;

class CreateRegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        return Register::$rules;
    }
    
    public function messages()
    {
        return [
            'name.required' => '用户名称不能为空',
            'name.alpha_dash' => '用户仅允许字母、数字、破折号（-）以及底线（_）',
            'name.max' => '用户名称最多20个字符',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱非法',
            'gender.required' => '性别不能为空',
            'stature.required' => '身高不能为空',
            'academy.required' => '学院不能为空',
            'middleschool.required' => '毕业中学不能为空',
            'telphone.required' => '手机号码不能为空',
            'postcode.required' => '邮编不能为空',
            'address.required' => '家庭住址不能为空',
            //'family.required' => 'required',
            'hobby.required' => '爱好特长不能为空',
            'personal.required' => '个人自述不能为空',
            //'certificate.required' => 'required',
            'reason.required' => '申请理由不能为空',
            'province.required' => '省份不能为空',

        ];
    }
}