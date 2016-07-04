<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateRegisterRequest;
use App\Http\Requests\Admin\UpdateRegisterRequest;
use App\Repository\RegisterRepository;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr, Response, Excel;
use App\Services\CommonServices;
use PHPExcel_Worksheet_Drawing;

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
     * @return \Illuminate\Http\JsonResponse
     * 审核报名学生
     */
    public function check(Request $request)
    {
        $id = (int)key($request->all());

        $result = $this->registerRepository->review($id);

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

    /**
     * @param $id
     * @return mixed
     * 导出单个学生的报名信息
     */
    public function export($id)
    {
        $data = $this->registerRepository->find($id);
        $common = config('common');
        $data->gender =  $data->gender ? '男' : '女';
        $data->province =  $common['province'][$data->province];
        $data->politics =  $common['politics'][$data->politics];
        $data->profession =  $common['academy'][$data->academy]['profession'][$data->profession];
        $data->academy =  $common['academy'][$data->academy]['name'];

        return Excel::create($data->name, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                //$sheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//水平居左
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:B10');
                $sheet->mergeCells('C2:H2');
                $sheet->mergeCells('D8:H8');
                $sheet->mergeCells('D9:H9');
                $sheet->mergeCells('D10:H10');
                $sheet->mergeCells('A11:H11');
                for($i=3; $i<=7; $i++) {
                    $sheet->mergeCells('F'.$i.':H'.$i);
                }

                //合并结束后开始设置titile
                $sheet->row(1, array('苏州科技大学敬文书院报名信息表'));
                $sheet->setCellValue('C2','基本信息');
                $sheet->setCellValue('C3','考生号');
                $sheet->setCellValue('C4','姓名');
                $sheet->setCellValue('C5','政治面貌');
                $sheet->setCellValue('C6','录取专业');
                $sheet->setCellValue('C7','本人电话');
                $sheet->setCellValue('C8','家庭地址');
                $sheet->setCellValue('C9','爱好特长');
                $sheet->setCellValue('C10','获奖情况');

                $sheet->setCellValue('E3','省份');
                $sheet->setCellValue('E4','性别');
                $sheet->setCellValue('E5','身高');
                $sheet->setCellValue('E6','毕业中学');
                $sheet->setCellValue('E7','邮编');

                $sheet->setCellValue('A11','家庭成员信息');
                $sheet->setCellValue('A12','姓名');
                $sheet->setCellValue('B12','年龄');
                $sheet->setCellValue('C12','与学生关系');
                $sheet->setCellValue('D12','工作单位');
                $sheet->setCellValue('E12','职业');
                $sheet->setCellValue('F12','年收入');
                $sheet->setCellValue('G12','健康状况');
                $sheet->setCellValue('H12','手机');

                $sheet->cells('A1:H1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A11', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('C2:H14', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->setWidth(array(
                    'A'     =>  11,
                    'B'     =>  10,
                    'C'     =>  12,
                    'D'     =>  26,
                    'E'     =>  13,
                    'F'     =>  9,
                    'G'     =>  10,
                    'H'     =>  12,
                ));
                //$sheet->setHeight(1, 22);
                $sheet->getDefaultRowDimension()->setRowHeight(18);
                //写入学生信息
                $sheet->setCellValue('D3',$data->student_id);
                $sheet->setCellValue('D4',$data->name);
                $sheet->setCellValue('D5', $data->politics);
                $sheet->setCellValue('D6',$data->profession);
                $sheet->setCellValue('D7',$data->telphone);
                $sheet->setCellValue('D8',$data->address);
                $sheet->setCellValue('D9',$data->hobby);
                $sheet->setCellValue('D10',$data->reward);

                $sheet->setCellValue('F3',$data->province);
                $sheet->setCellValue('F4',$data->gender);
                $sheet->setCellValue('F5',$data->stature);
                $sheet->setCellValue('F6',$data->middleschool);
                $sheet->setCellValue('F7',$data->postcode);

                //家庭成员信息
                $sheet->row(13, array(
                    $data->family->name1, $data->family->age1,$data->family->relation1,$data->family->work1,$data->family->position1,$data->family->salary1,$data->family->healthy1,$data->family->tel1
                ));
                $sheet->row(14, array(
                    $data->family->name2, $data->family->age2,$data->family->relation2,$data->family->work2,$data->family->position2,$data->family->salary2,$data->family->healthy2,$data->family->tel2
                ));
                //写入头像
                if(!empty($data->userpic)){
                    $img = new PHPExcel_Worksheet_Drawing();
                    $img->setPath(public_path($data->userpic));//写入图片路径
                    $img->setHeight(210);//写入图片高度
                    $img->setWidth(150);//写入图片宽度
                    //$img->setOffsetX(1);//写入图片在指定格中的X坐标值
                    //$img->setOffsetY(1);//写入图片在指定格中的Y坐标值
                    //$img->setRotation(1);//设置旋转角度
                    $img->getShadow()->setVisible(true);//
                    //$img->getShadow()->setDirection(50);//
                    $img->setCoordinates('A2');//设置图片所在表格位置
                    $img->setWorksheet($sheet);//把图片写到当前的表格中
                }

            });
        })->download('xlsx');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 批量导出报名表
     */
    public function exportAll(Request $request)
    {
        if(!($ids = $request->get('ids'))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        $ids = explode(',',ltrim($ids,','));

        $arr[] = ['考生号','姓名','性别','身高','省份','政治面貌','录取学院','录取专业','毕业中学','邮编','本人电话','家庭地址'];
        foreach($ids as $id){
            $data = $this->registerRepository->find($id);
            $common = config('common');
            $data->gender =  $data->gender ? '男' : '女';
            $data->province =  $common['province'][$data->province];
            $data->politics =  $common['politics'][$data->politics];
            $data->profession =  $common['academy'][$data->academy]['profession'][$data->profession];
            $data->academy =  $common['academy'][$data->academy]['name'];
            $arr[] = [
                $data->student_id,
                $data->name,
                $data->gender,
                $data->stature,
                $data->province,
                $data->politics,
                $data->academy,
                $data->profession,
                $data->middleschool,
                $data->postcode,
                $data->telphone,
                $data->address,
            ];
        }
        return Excel::create('报名信息表', function($excel) use ($arr) {
            $excel->sheet('mySheet', function ($sheet) use ($arr) {
                $nums = count($arr);
                $sheet->setAutoSize(true);
                //$sheet->getDefaultRowDimension()->setRowHeight(18);
                $sheet->fromArray($arr);
                $sheet->mergeCells('A1:L1');
                $sheet->row(1, array('苏州科技大学敬文书院报名信息表'));
                $sheet->cells('A1:L1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });
                $nums+=1;
                $sheet->cells('A2:L'.$nums, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->setWidth(array(
                    'A'     =>  12,
                    'B'     =>  12,
                    'C'     =>  10,
                    'D'     =>  10,
                    'E'     =>  12,
                    'F'     =>  12,
                    'G'     =>  24,
                    'H'     =>  24,
                    'I'     =>  16,
                    'J'     =>  10,
                    'K'     =>  14,
                    'L'     =>  24,
                ));
            });
        })->download('xlsx');
    }
}
