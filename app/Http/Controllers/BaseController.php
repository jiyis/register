<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/29
 * Time: 8:54
 */

namespace App\Http\Controllers;


use Jiyis\Generator\Controller\AppBaseController;
use Auth;

class BaseController extends AppBaseController
{
    protected $user_id;
    protected $username;
    protected $student_id;

    public function __construct()
    {
        $this->middleware('auth');
        if(Auth::guard('web')->check()){
            $this->user_id = Auth::guard('web')->user()->id;
            $this->username = Auth::guard('web')->user()->name;
            $this->student_id = Auth::guard('web')->user()->student_id;
        }
    }

}