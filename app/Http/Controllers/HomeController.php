<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\CommonServices;
use App\Http\Requests\Index\CreateRegisterRequest;
use App\Repository\RegisterRepository;

class HomeController extends BaseController
{
    protected $register;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegisterRepository $register)
    {
        parent::__construct();
        $this->register = $register;
        //身高范围
        view()->share('statures', CommonServices::getStatures());
        view()->share('academy', CommonServices::getAcademy());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('index/home');
    }

    public function store(CreateRegisterRequest $request)
    {
        $result = $this->adminUser->create($request->all());
        dd($request->all());
    }

    /**
     * @param Request $request
     * @return mixed
     * 根据选择的学院，动态展现专业
     */
    public function getAcademy(Request $request)
    {
        $academy_id = (int)$request->input('academy');
        $academy = config('common.academy');
        $res = $academy[$academy_id]['profession'];
        return response()->json($res);
    }
}
