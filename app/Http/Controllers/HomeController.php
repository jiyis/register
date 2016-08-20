<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\CommonServices;
use App\Http\Requests\Index\CreateRegisterRequest;
use App\Repository\RegisterRepository;
use Toastr, Auth;

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
        $register = $this->register->skipCriteria()->findWhere(['user_id'=>$this->user_id])->first();
        //报名结束
        if($this->register->finish()){
            return view('index/finish',compact('register'));
        }
        //初审结束，录取进行中
        if($this->register->reviewFinish()){
            return view('index/review',compact('register'));
        }
        //判断是否已经报名成功，报名后不允许再次进入，初审进行中
        if(!$this->register->check($this->user_id)){
            return view('index/result',compact('register'));
        }
        //判断是否上传头像，否则跳转到上传页面
        if(empty(Auth::guard('web')->user()->userpic)){
            Toastr::error('请先上传个人照片才可报名！');
            return redirect('changepwd');
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
        Toastr::success('报名成功!');
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

    /**
     * @return mixed
     * 下载个人自述的pdf
     */
    public function getword()
    {
        $file = storage_path('app/public/apply.pdf');
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($file,'苏州科技大学敬文新教育书院个人自述申请表.pdf',$headers);
    }

}
