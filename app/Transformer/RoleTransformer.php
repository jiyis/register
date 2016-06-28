<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/12
 * Time: 13:30
 */

namespace App\Transformer;


use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $model)
    {
        return [
            'id'   => (int)$model->id,
            'name' => $model->display_name,
        ];
    }

}