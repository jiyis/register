<?php

/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/12
 * Time: 9:44
 */
namespace App\Transformer;

use App\Models\AdminUser;
use League\Fractal\TransformerAbstract;

class AdminUserTransformer extends TransformerAbstract
{

    public function transform(AdminUser $model)
    {
        return [
            'id'         => (int)$model->id,
            'name'       => $model->name,
            'nickname'   => $model->nickname,
            'email'      => $model->email,
            'is_super'   => $model->is_super,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            //'roles'      => \App\Models\Role::select(['id','display_name'])->get(),
        ];
    }

}