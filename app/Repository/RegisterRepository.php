<?php

namespace App\Repository;

use App\Models\Register;
use App\Models\System;
use App\User;
use Jiyis\Generator\Common\BaseRepository;
use App\Criteria\RegisterCriteria;
use App\Criteria\RegisterCheckCriteria;

class RegisterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'province',
        'stature',
        'academy',
    ];
    protected $system;


    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot(){
        $this->system =  System::find(1);
        $this->pushCriteria(new RegisterCriteria());
        if($this->system->register_status == 1 && $this->system->review_status == 0){
            $this->pushCriteria(new RegisterCheckCriteria());
        }
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Register::class;
    }

    /**
     * @param $id
     * @return bool
     * 判断是否报名过
     */
    public function check($id)
    {
        $result = $this->model->where('user_id',$id)->count();
        if($result>0){
            return false;
        }
        return true;
    }

    /**
     * 是否报名完成
     */
    public function finish()
    {
        //file_exists(storage_path('exports/enroll.xls')) && 
        if($this->system->register_status == 0) return true;
        return false;
    }
    /**
     * 是否初审完成
     */
    public function reviewFinish()
    {
        if($this->system->register_status == 1 && $this->system->review_status == 0) return true;
        return false;
    }
    /**
     * @param $id
     * @return mixed
     * 审核和取消审核切换
     */
    public function review($id,$value,$type='review_state')
    {
        $register = $this->model->find($id);
        $result = $this->model->where('id',$id)->update([$type=>$value]);

        return $result;
    }
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     * 查找单个报名信息
     */
    public function find($id, $columns = ['*'])
    {
        $register =  parent::find($id, $columns);
        $user = User::find($register->user_id);
        $register->name = $user->name;
        $register->student_id = $user->student_id;
        $register->userpic = $user->userpic;

        return $register;
    }

    /**
     * @param array $columns
     * @return mixed
     * 所有报名成员信息
     */
    public function all($columns = ['*'])
    {
        $registers =  parent::all($columns);
        $idrows = array_column($registers->toArray(),'user_id');
        $allusers = User::whereIn('id',$idrows)->get()->toArray();
        foreach ($allusers as $index => $user) {
            $users[$user['id']] = $user;
        }
        $common = config('common');
        foreach ($registers as $key => $register) {
            $register->student_id = $users[$register->user_id]['student_id'];
            $register->name = $users[$register->user_id]['name'];
            $register->userpic = $users[$register->user_id]['userpic'];
            $register->gender =  $register->gender ? '男' : '女';
            $register->province =  $common['province'][$register->province];
            //$register->politics =  $common['politics'][$register->politics];
            //$register->profession =  $common['academy'][$register->academy]['profession'][$register->profession];
            $register->academy =  $common['academy'][$register->academy]['name'];

            $register->state = $this->transformState($register);
            $registers[$key] = $register;
        }
        return $registers;
    }

    /**
     * 格式化显示操作按钮
     */
    public function transformState($register)
    {

        //先检验报名总开关
        if($this->system->register_status == 0){
            return  '';
        }elseif ($this->system->register_status == 1 && $this->system->review_status == 1){ //初审进行中
            if($register->review_state == 0){
                $register->state = '<a class="btn btn-primary btn-xs check" data-href="'.route('admin.registers.check',['id' => $register->id,'value'=> 1,'type'=> 'review_state']).'"><i class="fa fa-minus-circle"></i> 初审PASS</a>    <a class="btn btn-success btn-xs check" data-href="'.route('admin.registers.check',['id' => $register->id,'value'=> 2,'type'=> 'review_state']).'"><i class="fa fa-plus-circle"></i> 初审通过</a>';
            }elseif($register->review_state == 1){
                $register->state = '<a class="btn btn-warning btn-xs check" data-href="'.route('admin.registers.goinit',['id' => $register->id]).'"><i class="fa fa-minus-circle"></i> 撤销初审PASS</a>';
            }else{
                $register->state = '<a class="btn btn-danger btn-xs check" data-href="'.route('admin.registers.goinit',['id' => $register->id]).'"><i class="fa fa-minus-circle"></i> 撤销初审通过</a>';
            }
        }elseif ($this->system->register_status == 1 && $this->system->review_status == 0 ){ //录取进行中
            if($register->review_state == 2 && $register->register_state == 0){
                $register->state = '<a class="btn btn-danger btn-xs check" data-href="'.route('admin.registers.check',['id' => $register->id,'value'=> 1,'type'=> 'register_state']).'"><i class="fa fa-minus-circle"></i> 录取PASS</a>    <a class="btn btn-primary btn-xs check" data-href="'.route('admin.registers.check',['id' => $register->id,'value'=> 2,'type'=> 'register_state']).'"><i class="fa fa-plus-circle"></i> 录取通过</a>';
            }elseif($register->review_state == 2 && $register->register_state == 2){
                $register->state = '<a class="btn btn-warning btn-xs check" data-href="'.route('admin.registers.check',['id' => $register->id,'value'=> 0,'type'=> 'register_state']).'"><i class="fa fa-minus-circle"></i> 撤销录取</a>';
            } elseif($register->review_state == 2 && $register->register_state == 1){
                $register->state = '<a class="btn btn-warning btn-xs check" data-href="'.route('admin.registers.check',['id' => $register->id,'value'=> 0,'type'=> 'register_state']).'"><i class="fa fa-minus-circle"></i> 撤销PASS</a>';
            }
        }

        return  $register->state;
    }
    /**
     * @param $value
     * @return mixed
     * 根据状态返回录取状态的人数
     * 0、未操作 1、未通过录取 3、已录取
     */
    public function getNumOfRegister($value)
    {
       return parent::findWhere(['register_state'=>$value])->count();
    }

    /**
     * @param $value
     * @return mixed
     * 根据状态返回审核状态报名的人数
     * 0、未操作 1、未通过初审 2、已初审
     */
    public function getNumOfReview($value)
    {
        return parent::findWhere(['review_state'=>$value])->count();
    }

    /**
     * @param array $user_id
     * 根据用户ID返回姓名
     */
    public function getNameById(array $user_id)
    {
        return User::whereIn('id',$user_id)->select('student_id','name')->get();
    }
    /*public function presenter()
    {
        return "App\\Presenter\\RegisterPresenter";
    }*/
}
