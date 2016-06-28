<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\Register;

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
            'studentID.required' => '考生号不能为空',
            'province.required' => '省份不能为空',
            'politics.required' => '政治面貌不能为空',
            'stature.required' => '身高不能为空',
            'academy.required' => '学院不能为空',
            'profession.required' => '专业不能为空',
            'middleschool.required' => '毕业中学不能为空',
            'telphone.required' => '手机号码不能为空',
            'postcode.required' => '邮编不能为空',
            'address.required' => '家庭住址不能为空',
            'family.required' => '家庭成员不能为空',
            'hobby.required' => '爱好特长不能为空',
            'reward.required' => '获奖情况不能为空',
            'personal.required' => '个人自述不能为空',
            'certificate.required' => '获奖证书不能为空',
            'video.required' => '视频文件不能为空',
        ];
    }
}
