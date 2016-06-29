<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/29
 * Time: 13:48
 */
namespace App\Http\Requests\Index;

use App\Http\Requests\Request;

class LoginRequest extends Request
{


    public function rules()
    {
        return [
            'student_id' => 'required',
            'password' => 'required',
        ];
    }
}