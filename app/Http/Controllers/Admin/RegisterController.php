<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateRegisterRequest;
use App\Http\Requests\Admin\UpdateRegisterRequest;
use App\Repository\RegisterRepository;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr, Response;
use App\Services\CommonServices;
use Excel;

class RegisterController extends BaseController
{
    /** @var  RegisterRepository */
    private $registerRepository;

    public function __construct(RegisterRepository $registerRepo)
    {
        parent::__construct();
        $this->registerRepository = $registerRepo;

        Breadcrumbs::register('admin-registers', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('报名成员管理', route('admin.registers.index'));
        });
        //身高范围
        view()->share('statures', CommonServices::getStatures());
        view()->share('academy', CommonServices::getAcademy());
        view()->share('profession', CommonServices::getProfession());
    }

    /**
     * Display a listing of the Register.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        Breadcrumbs::register('admin-registers-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-registers');
            $breadcrumbs->push('报名成员列表', route('admin.registers.index'));
        });

        $registers = $this->registerRepository->all();

        return view('admin.registers.index')
            ->with('registers', $registers);
    }

    /**
     * Show the form for creating a new Register.
     *
     * @return Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-registers-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-registers');
            $breadcrumbs->push('新建报名成员', route('admin.registers.create'));
        });
        $register = new \stdClass();
        $register->personal = '';
        $register->certificate  = '';
        $register->video = '';
        return view('admin.registers.create',compact('register'));
    }

    /**
     * Store a newly created Register in storage.
     *
     * @param CreateRegisterRequest $request
     *
     * @return Response
     */
    public function store(CreateRegisterRequest $request)
    {
        $input = $request->all();

        $register = $this->registerRepository->create($input);

        Toastr::success('报名成员保存成功.');

        return redirect(route('admin.registers.index'));
    }

    /**
     * Display the specified Register.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $register = $this->registerRepository->findWithoutFail($id);

        if (empty($register)) {
            Toastr::error('报名成员未找到！');

            return redirect(route('admin.registers.index'));
        }

        return view('admin.registers.show')->with('register', $register);
    }

    /**
     * Show the form for editing the specified Register.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        Breadcrumbs::register('admin-registers-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-registers');
            $breadcrumbs->push('编辑报名成员', route('admin.registers.edit', ['id' => $id]));
        });

        /*$register = $this->registerRepository->findWithoutFail($id);

        if (empty($register)) {
            Toastr::error('Register not found');

            return redirect(route('admin.registers.index'));
        }*/
        $register = $this->registerRepository->find($id);
        return view('admin.registers.edit')->with('register', $register);
    }

    /**
     * Update the specified Register in storage.
     *
     * @param  int              $id
     * @param UpdateRegisterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegisterRequest $request)
    {
        $register = $this->registerRepository->findWithoutFail($id);

        if (empty($register)) {
            Toastr::error('报名成员不存在');

            return redirect(route('admin.registers.index'));
        }

        $register = $this->registerRepository->update($request->all(), $id);

        Toastr::success('报名成员更新成功.');

        return redirect(route('admin.registers.index'));
    }

    /**
     * Remove the specified Register from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->registerRepository->delete($id);

        //Toastr::success('Register删除成功.');

        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

     /**
     * Delete multi users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
            $result = $this->registerRepository->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * 下载文件
     */
    public function download(Request $request)
    {
        $filename = $request->get('path');
        $file = public_path($filename);

        if(file_exists($file)){
            return response()->download($file);
        }else{
            Toastr::error('文件不存在！');

            return redirect(route('admin.registers.index'));
        }
    }

    public function export($id)
    {
        $data = $this->registerRepository->find($id)->toArray();
       unset($data['family']);
        return Excel::create('报名', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->mergeCells('A1:H1');
                $sheet->row(1, array('江苏师范大学静文书院报名信息表'));
                $sheet->row(2, array('基本信息','基本信息1'));
                $sheet->cells('A1:H1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });
                $sheet->mergeCells('A2:B7');
                $sheet->mergeCells('C2:H2');
                $sheet->mergeCells('D7:H7');
                for($i=3; $i<=6; $i++) {
                    $sheet->mergeCells('F'.$i.':H'.$i);
                }
                $sheet->setCellValue('C3','操你妈');
                /*$sheet->fromArray(array(
                    array('标题', '名字'),
                    array('data1', 'data2'),
                    array('data3', 'data4')
                ));*/
            });
        })->download('xlsx');
    }
}
