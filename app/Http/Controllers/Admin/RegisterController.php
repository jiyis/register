<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateRegisterRequest;
use App\Http\Requests\Admin\UpdateRegisterRequest;
use App\Repository\RegisterRepository;
use App\Repository\SystemRepository;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr, Response, Excel,File;
use App\Services\CommonServices;
use PHPExcel_Worksheet_Drawing;

class RegisterController extends BaseController
{
    /** @var  RegisterRepository */
    private $registerRepository;
    private $systemRepository;
    private $filepath;

    public function __construct(RegisterRepository $registerRepo,SystemRepository $systemRepository)
    {
        parent::__construct();
        $this->registerRepository = $registerRepo;
        $this->systemRepository = $systemRepository;
        $this->filepath = storage_path('exports/enroll.xls');

        Breadcrumbs::register('admin-registers', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('报名成员管理', route('admin.registers.index'));
        });
        //身高范围
        view()->share('statures', CommonServices::getStatures());
        view()->share('academy', CommonServices::getAcademy());
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
        $registerCount = $this->registerRepository->getNumOfReview(2);
        $unenrollCount = $this->registerRepository->getNumOfRegister(1);
        $enrollCount = $this->registerRepository->getNumOfRegister(2);
        $state = file_exists($this->filepath);

        return view('admin.registers.index')
            ->with('registers', $registers)->with('registerCount', $registerCount)->with('enrollCount', $enrollCount)->with('unenrollCount',$unenrollCount)->with('state',$state);
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
     * @return mixed
     * 结束报名
     */
    public function complete()
    {
        $this->systemRepository->update(['register_status'=>0,'review_status'=>0],1);
        $enrollers = $this->registerRepository->findWhere(['register_state'=>2],['user_id'])->toArray();
        $enrollers = $this->registerRepository->getNameById($enrollers)->toArray();

        return Excel::create('enroll', function($excel) use ($enrollers) {
            $excel->sheet('mySheet', function ($sheet) use ($enrollers) {

                $sheet->fromArray($enrollers);
                //$sheet->row(1, array('敬文新教育录取名单'));
                /*$sheet->cells('A', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });*/

                $sheet->setWidth(array(
                    'A'     =>  16,
                    'B'     =>  16,
                ));
                $sheet->setCellValue('A1','考生号');
                $sheet->setCellValue('B1','姓名');
            });
        })->store('xls')->export('xls');
    }
    public function open()
    {
        $result = File::delete($this->filepath);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 审核报名学生
     */
    public function check(Request $request)
    {
        $data = $request->all();
        $id = (int)$data['id'];
        $value = (int)$data['value'];
        $type = $data['type'];

        $result = $this->registerRepository->review($id,$value,$type);

        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 撤销到最初始状态
     */
    public function goinit(Request $request)
    {
        $data = $request->all();
        $id = (int)$data['id'];

        $this->registerRepository->review($id,0,'register_state');
        $result = $this->registerRepository->review($id,0,'review_state');

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
        //$data->politics =  $common['politics'][$data->politics];
        //$data->profession =  $common['academy'][$data->academy]['profession'][$data->profession];
        $data->academy =  $common['academy'][$data->academy]['name'];

        return Excel::create($data->name, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                //$sheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//水平居左
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A3:B9');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('D8:G8');
                $sheet->mergeCells('D9:G9');
               // $sheet->mergeCells('D10:G10');
                $sheet->mergeCells('A10:G10');
                for($i=3; $i<=7; $i++) {
                    $sheet->mergeCells('F'.$i.':G'.$i);
                }
                $sheet->mergeCells('A16:G16');
                $sheet->mergeCells('A17:G19');

                $sheet->mergeCells('A20:G20');

                $sheet->mergeCells('A27:G27');

                for($i=21; $i<=26; $i++) {
                    $sheet->mergeCells('A'.$i.':B'.$i);
                    $sheet->mergeCells('E'.$i.':G'.$i);
                }

                //合并结束后开始设置titile
                $sheet->row(1, array('敬文新教育书院报名信息表'));
                $sheet->setCellValue('A2','基本信息');
                $sheet->setCellValue('C3','考生号');
                $sheet->setCellValue('C4','姓名');
                $sheet->setCellValue('C5','邮箱地址');
                $sheet->setCellValue('C6','录取学院');
                $sheet->setCellValue('C7','本人电话');
                $sheet->setCellValue('C8','爱好特长');
                $sheet->setCellValue('C9','家庭住址');

                $sheet->setCellValue('E3','省份');
                $sheet->setCellValue('E4','性别');
                $sheet->setCellValue('E5','身高');
                $sheet->setCellValue('E6','毕业中学');
                $sheet->setCellValue('E7','邮编');

                $sheet->setCellValue('A10','家庭成员信息');

                $sheet->setCellValue('A11','姓名');
                $sheet->setCellValue('B11','年龄');
                $sheet->setCellValue('C11','与学生关系');
                $sheet->setCellValue('D11','工作单位');
                $sheet->setCellValue('E11','职业');
                $sheet->setCellValue('F11','健康状况');
                $sheet->setCellValue('G11','手机');


                $sheet->setCellValue('A16','申请理由');
                $sheet->setCellValue('A20','获奖情况');

                $sheet->setCellValue('A21','奖项名称');
                $sheet->setCellValue('C21','等第');
                $sheet->setCellValue('D21','获奖时间');
                $sheet->setCellValue('E21','颁发部门');

                //$sheet->setCellValue('A26','个人自述');


                $sheet->cells('A17:G19', function($cells) {
                    $cells->setValignment('center');
                });

                $sheet->cells('A1:G1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A9', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A10', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('A16', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A20', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('A21', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:G12', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->setWidth(array(
                    'A'     =>  10,
                    'B'     =>  8,
                    'C'     =>  12,
                    'D'     =>  28,
                    'E'     =>  13,
                    'F'     =>  9,
                    'G'     =>  22,
                ));
                //$sheet->setHeight(1, 22);
                $sheet->getDefaultRowDimension()->setRowHeight(18);
                //写入学生信息

                $sheet->getStyle('D3')->getNumberFormat()->setFormatCode("@");
                $sheet->setCellValue('D3',$data->student_id.'  ');
                $sheet->setCellValue('D4',$data->name);
                $sheet->setCellValue('D5', $data->email);
                $sheet->setCellValue('D6',$data->academy);
                $sheet->setCellValue('D7',$data->telphone);
                $sheet->setCellValue('D8',$data->hobby);
                $sheet->setCellValue('D9',$data->address);
                //$sheet->setCellValue('D10',$data->reward);
                $sheet->setCellValue('A17',$data->reason);

                $sheet->setCellValue('F3',$data->province);
                $sheet->setCellValue('F4',$data->gender);
                $sheet->setCellValue('F5',$data->stature);
                $sheet->setCellValue('F6',$data->middleschool);
                $sheet->setCellValue('F7',$data->postcode);

                //家庭成员信息
                $sheet->row(12, array(
                    $data->family->name1, $data->family->age1,$data->family->relation1,$data->family->work1,$data->family->position1,$data->family->healthy1,$data->family->tel1
                ));
                $sheet->row(13, array(
                    $data->family->name2, $data->family->age2,$data->family->relation2,$data->family->work2,$data->family->position2,$data->family->healthy2,$data->family->tel2
                ));
                $sheet->row(14, array(
                    $data->family->name3, $data->family->age3,$data->family->relation3,$data->family->work3,$data->family->position3,$data->family->healthy3,$data->family->tel3
                ));
                $sheet->row(15, array(
                    $data->family->name4, $data->family->age4,$data->family->relation4,$data->family->work4,$data->family->position4,$data->family->healthy4,$data->family->tel4
                ));

                $sheet->row(22, array(
                    $data->reward->name1, $data->reward->level1,$data->reward->time1,$data->reward->deparment1
                ));
                $sheet->row(23, array(
                    $data->reward->name2, $data->reward->level2,$data->reward->time2,$data->reward->deparment2
                ));
                $sheet->row(24, array(
                    $data->reward->name3, $data->reward->level3,$data->reward->time3,$data->reward->deparment3
                ));
                $sheet->row(25, array(
                    $data->reward->name4, $data->reward->level4,$data->reward->time4,$data->reward->deparment4
                ));
                $sheet->row(26, array(
                    $data->reward->name5, $data->reward->level5,$data->reward->time5,$data->reward->deparment5
                ));


                //写入头像
                if(!empty($data->userpic)){
                    $img = new PHPExcel_Worksheet_Drawing();
                    $img->setPath(public_path($data->userpic));//写入图片路径
                    $img->setHeight(165);//写入图片高度
                    $img->setWidth(125);//写入图片宽度
                    //$img->setOffsetX(1);//写入图片在指定格中的X坐标值
                    //$img->setOffsetY(1);//写入图片在指定格中的Y坐标值
                    //$img->setRotation(1);//设置旋转角度
                    $img->getShadow()->setVisible(true);//
                    //$img->getShadow()->setDirection(50);//
                    $img->setCoordinates('A3');//设置图片所在表格位置
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

        $arr[] = ['考生号','姓名','性别','身高','省份','邮箱地址','录取学院','毕业中学','邮编','本人电话','家庭地址','个人爱好'];
        foreach($ids as $id){
            $data = $this->registerRepository->find($id);
            $common = config('common');
            $data->gender =  $data->gender ? '男' : '女';
            $data->province =  $common['province'][$data->province];
            //$data->politics =  $common['politics'][$data->politics];
            //$data->profession =  $common['academy'][$data->academy]['profession'][$data->profession];
            $data->academy =  $common['academy'][$data->academy]['name'];
            $arr[] = [
                $data->student_id,
                $data->name,
                $data->gender,
                $data->stature,
                $data->province,
                $data->email,
                $data->academy,
                $data->middleschool,
                $data->postcode,
                $data->telphone,
                $data->address,
                $data->hobby,
            ];
        }
        return Excel::create('报名信息表', function($excel) use ($arr) {
            $excel->sheet('mySheet', function ($sheet) use ($arr) {
                $nums = count($arr);

                //$sheet->getDefaultRowDimension()->setRowHeight(18);
                $sheet->fromArray($arr);
                $sheet->mergeCells('A1:L1');
                $sheet->row(1, array('敬文新教育书院报名信息表'));
                $sheet->cells('A1:L1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });
                $nums+=1;
                $sheet->cells('A2:L'.$nums, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->setWidth(array(
                    'A'     =>  16,
                    'B'     =>  12,
                    'C'     =>  12,
                    'D'     =>  12,
                    'E'     =>  16,
                    'F'     =>  20,
                    'G'     =>  22,
                    'H'     =>  22,
                    'I'     =>  12,
                    'J'     =>  14,
                    'K'     =>  38,
                    'L'     =>  40,
                ));
            });
        })->download('xlsx');
    }
    /**************************************************************************/
    public function getAllExcel()
    {
        $registers = $this->registerRepository->all();
        foreach ($registers as $k=>$v){
            $this->exportNew($v);
        }
    }
    public function exportNew($data)
    {
        File::deleteDirectory(storage_path('allstudents'));
        return Excel::create($data->student_id.$data->name, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                //$sheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//水平居左
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A3:B9');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('D8:G8');
                $sheet->mergeCells('D9:G9');
                // $sheet->mergeCells('D10:G10');
                $sheet->mergeCells('A10:G10');
                for($i=3; $i<=7; $i++) {
                    $sheet->mergeCells('F'.$i.':G'.$i);
                }
                $sheet->mergeCells('A16:G16');
                $sheet->mergeCells('A17:G19');

                $sheet->mergeCells('A20:G20');

                $sheet->mergeCells('A27:G27');
                //$sheet->mergeCells('A28:B28');
                //$sheet->mergeCells('A29:B29');

                for($i=21; $i<=26; $i++) {
                    $sheet->mergeCells('A'.$i.':B'.$i);
                    $sheet->mergeCells('E'.$i.':G'.$i);
                }

                //合并结束后开始设置titile
                $sheet->row(1, array('敬文新教育书院报名信息表'));
                $sheet->setCellValue('A2','基本信息');
                $sheet->setCellValue('C3','考生号');
                $sheet->setCellValue('C4','姓名');
                $sheet->setCellValue('C5','邮箱地址');
                $sheet->setCellValue('C6','录取学院');
                $sheet->setCellValue('C7','本人电话');
                $sheet->setCellValue('C8','爱好特长');
                $sheet->setCellValue('C9','家庭住址');

                $sheet->setCellValue('E3','省份');
                $sheet->setCellValue('E4','性别');
                $sheet->setCellValue('E5','身高');
                $sheet->setCellValue('E6','毕业中学');
                $sheet->setCellValue('E7','邮编');

                $sheet->setCellValue('A10','家庭成员信息');

                $sheet->setCellValue('A11','姓名');
                $sheet->setCellValue('B11','年龄');
                $sheet->setCellValue('C11','与学生关系');
                $sheet->setCellValue('D11','工作单位');
                $sheet->setCellValue('E11','职业');
                $sheet->setCellValue('F11','健康状况');
                $sheet->setCellValue('G11','手机');


                $sheet->setCellValue('A16','申请理由');
                $sheet->setCellValue('A20','获奖情况');

                $sheet->setCellValue('A21','奖项名称');
                $sheet->setCellValue('C21','等第');
                $sheet->setCellValue('D21','获奖时间');
                $sheet->setCellValue('E21','颁发部门');
                $sheet->setCellValue('A27','其他信息');

                $sheet->setCellValue('A28','文理科');
                $sheet->setCellValue('B28','名次');
                $sheet->setCellValue('C28','是否入围');
                $sheet->setCellValue('D28','批次');
                $sheet->setCellValue('E28','录取专业');
                $sheet->setCellValue('F28','投档成绩');
                $sheet->setCellValue('G28','民族');
                //$sheet->setCellValue('A26','个人自述');


                $sheet->cells('A17:G19', function($cells) {
                    $cells->setValignment('center');
                });

                $sheet->cells('A1:G1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontSize(16);
                });
                $sheet->cells('A9', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A10', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A27', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A16', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A20', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('A21', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:G12', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->setWidth(array(
                    'A'     =>  10,
                    'B'     =>  8,
                    'C'     =>  12,
                    'D'     =>  28,
                    'E'     =>  13,
                    'F'     =>  9,
                    'G'     =>  22,
                ));
                //$sheet->setHeight(1, 22);
                $sheet->getDefaultRowDimension()->setRowHeight(18);
                //写入学生信息

                $sheet->getStyle('D3')->getNumberFormat()->setFormatCode("@");
                $sheet->setCellValue('D3',$data->student_id.'  ');
                $sheet->setCellValue('D4',$data->name);
                $sheet->setCellValue('D5', $data->email);
                $sheet->setCellValue('D6',$data->academy);
                $sheet->setCellValue('D7',$data->telphone);
                $sheet->setCellValue('D8',$data->hobby);
                $sheet->setCellValue('D9',$data->address);
                //$sheet->setCellValue('D10',$data->reward);
                $sheet->setCellValue('A17',$data->reason);

                $sheet->setCellValue('F3',$data->province);
                $sheet->setCellValue('F4',$data->gender);
                $sheet->setCellValue('F5',$data->stature);
                $sheet->setCellValue('F6',$data->middleschool);
                $sheet->setCellValue('F7',$data->postcode);

                //家庭成员信息
                $sheet->row(12, array(
                    $data->family->name1, $data->family->age1,$data->family->relation1,$data->family->work1,$data->family->position1,$data->family->healthy1,$data->family->tel1
                ));
                $sheet->row(13, array(
                    $data->family->name2, $data->family->age2,$data->family->relation2,$data->family->work2,$data->family->position2,$data->family->healthy2,$data->family->tel2
                ));
                $sheet->row(14, array(
                    $data->family->name3, $data->family->age3,$data->family->relation3,$data->family->work3,$data->family->position3,$data->family->healthy3,$data->family->tel3
                ));
                $sheet->row(15, array(
                    $data->family->name4, $data->family->age4,$data->family->relation4,$data->family->work4,$data->family->position4,$data->family->healthy4,$data->family->tel4
                ));

                $sheet->row(22, array(
                    $data->reward->name1, $data->reward->level1,$data->reward->time1,$data->reward->deparment1
                ));
                $sheet->row(23, array(
                    $data->reward->name2, $data->reward->level2,$data->reward->time2,$data->reward->deparment2
                ));
                $sheet->row(24, array(
                    $data->reward->name3, $data->reward->level3,$data->reward->time3,$data->reward->deparment3
                ));
                $sheet->row(25, array(
                    $data->reward->name4, $data->reward->level4,$data->reward->time4,$data->reward->deparment4
                ));
                $sheet->row(26, array(
                    $data->reward->name5, $data->reward->level5,$data->reward->time5,$data->reward->deparment5
                ));
                //额外信息
                $extraInfo = \DB::table('students')->where('student_id',$data->student_id)->first();

                $sheet->setCellValue('A29',$extraInfo->type);
                $sheet->setCellValue('B29',$extraInfo->level);
                $sheet->setCellValue('C29',$extraInfo->isart);
                $sheet->setCellValue('D29',$extraInfo->pici);
                $sheet->setCellValue('E29',$extraInfo->profession);
                $sheet->setCellValue('F29',$extraInfo->score);
                $sheet->setCellValue('G29',$extraInfo->nation);

                //写入头像
                if(!empty($data->userpic)){
                    $img = new PHPExcel_Worksheet_Drawing();
                    $img->setPath(public_path($data->userpic));//写入图片路径
                    $img->setHeight(165);//写入图片高度
                    $img->setWidth(125);//写入图片宽度
                    //$img->setOffsetX(1);//写入图片在指定格中的X坐标值
                    //$img->setOffsetY(1);//写入图片在指定格中的Y坐标值
                    //$img->setRotation(1);//设置旋转角度
                    $img->getShadow()->setVisible(true);//
                    //$img->getShadow()->setDirection(50);//
                    $img->setCoordinates('A3');//设置图片所在表格位置
                    $img->setWorksheet($sheet);//把图片写到当前的表格中
                }

            });
        })->store('xls',storage_path('allstudents'));
    }

}
