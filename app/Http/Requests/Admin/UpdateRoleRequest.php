<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/15
 * Time: 15:34
 */

namespace App\Http\Requests\Admin;

use App\Models\Role;

class UpdateRoleRequest extends Request
{
    public function rules()
    {
        $role = Role::find($this->role);

        return [
            'name'       => 'required|unique:roles,name,'.$role->id,
            'display_name' => 'sometimes|max:100|required|unique:roles,display_name,'.$role->display_name,
            'description' => 'sometimes|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => '角色名已存在',
            'name.required' => '角色名不能为空',
            'display_name.required' => '显示名称不能为空',
            'display_name.unique' => '显示名称已存在',
            'display_name.max' => '角色显示名称最多100个字符',
            'description.max' => '角色说明最多100字符'
        ];
    }
}