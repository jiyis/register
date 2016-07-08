<?php

namespace App\Repository;

use App\Models\Register;
use App\User;
use Jiyis\Generator\Common\BaseRepository;
use App\Criteria\RegisterCriteria;

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

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot(){
        $this->pushCriteria(new RegisterCriteria());
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
     * @param $id
     * @return mixed
     * 审核和取消审核切换
     */
    public function review($id)
    {
        $register = $this->model->find($id);
        $result = $this->model->where('id',$id)->update(['state'=>1]);

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
            $register->gender =  $register->gender ? '男' : '女';
            $register->province =  $common['province'][$register->province];
            //$register->politics =  $common['politics'][$register->politics];
            //$register->profession =  $common['academy'][$register->academy]['profession'][$register->profession];
            $register->academy =  $common['academy'][$register->academy]['name'];
            $registers[$key] = $register;
        }
        return $registers;
    }


    /*public function presenter()
    {
        return "App\\Presenter\\RegisterPresenter";
    }*/
}
