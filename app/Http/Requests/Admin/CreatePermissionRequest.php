<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/17
 * Time: 8:30
 */

namespace App\Http\Requests\Admin;


class CreatePermissionRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:permissions,name',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限名称必须',
            'name.max' => '权限名称最多100个字符',
            'name.unique' => '该权限名称已存在',
            'display_name.max' => '权限显示名称最多100个字符',
            'description.max' => '权限说明最多100字符'
        ];
    }
}