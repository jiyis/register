<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/2
 * Time: 15:25
 * Desc：
 */

namespace App\Transformer;

use App\Models\Register;
use League\Fractal\TransformerAbstract;

class RegisterTransformer extends TransformerAbstract
{
    public function transform(Register $register)
    {
        $common = config('common');
        return collect([
            'items' => [$register]
        ]);
        return collect([
            'user_id'      => (int) $register->user_id,
            'gender'   => $register->gender ? '男' : '女',
            'politics' => $common['politics'][$register->politics],
            'academy' => $common['academy'][$register->academy],
            'profession' => $common['academy'][$register->academy]['profession'][$register->profession],
            'academy' => $common['academy'][$register->academy],
            'academy' => $register->middleschool,
        ]);
    }
}