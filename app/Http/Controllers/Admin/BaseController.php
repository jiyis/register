<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/2
 * Time: 11:16
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Breadcrumbs,Auth;
use Jiyis\Generator\Controller\AppBaseController;


class BaseController extends AppBaseController
{
    public function __construct()
    {
        //$this->middleware('auth.admin');

        //view()->share('menus', CommonServices::getMenus());
        view()->share('curuser', Auth::guard('admin')->user());
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('控制台', function ($breadcrumbs) {
            $breadcrumbs->push('控制台', route('admin.home'));
        });
    }
}
