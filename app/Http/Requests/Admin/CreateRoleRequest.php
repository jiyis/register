<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/15
 * Time: 15:34
 */

namespace App\Http\Requests\Admin;

class CreateRoleRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:roles,name',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '角色名称不能为空',
            'name.max' => '角色名称最多100个字符',
            'name.unique' => '该角色名称已存在',
            'display_name.max' => '角色显示名称最多100个字符',
            'description.max' => '角色说明最多100字符'
        ];
    }
}