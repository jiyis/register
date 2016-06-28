<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/2
 * Time: 11:16
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;

class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }
    /**
     * Show the application 控制台.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumbs::register('admin-home-index', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('个人面板', route('admin.home'));
        });
        return view('admin.home');
    }
}
