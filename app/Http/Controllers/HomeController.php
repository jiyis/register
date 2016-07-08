<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\CommonServices;
use App\Http\Requests\Index\CreateRegisterRequest;
use App\Repository\RegisterRepository;
use Toastr;

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
        //判断是否已经报名成功，报名后不允许再次进入
        if(!$this->register->check($this->user_id)){
            $register = $this->register->findWhere(['user_id'=>$this->user_id])->first();
            return view('index/result',compact('register'));
        }
        return view('index/home');
    }

    /**
     * @param CreateRegisterRequest $request
     * @return mixed
     * 保存报名信息
     */
    public function store(CreateRegisterRequest $request)
    {
        $attributes = $request->all();
        $attributes['user_id'] = $this->user_id;
        $result = $this->register->create($attributes);
        if(!$result) {
            Toastr::error('报名失败!');
            return redirect(url('/home'));
        }
        Toastr::success('新用户添加成功!');
        return redirect('home');
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
