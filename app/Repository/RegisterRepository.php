<?php

namespace App\Repository;

use App\Models\Register;
use App\User;
use Jiyis\Generator\Common\BaseRepository;

class RegisterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'province',
        'politics',
        'stature',
        'academy',
        'profession'
    ];

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
     * @param array $attributes
     * @return mixed
     * 把家庭成员组合成json格式存储
     */
    public function create(array $attributes)
    {
        $attributes['family'] = json_encode($attributes['family']);
        $register = parent::create($attributes);
        return $register;
    }

    public function find($id, $columns = ['*'])
    {
        $register =  parent::find($id, $columns);
        $user = User::find($register->user_id);
        $register->name = $user->name;
        $register->student_id = $user->student_id;
        return $register;
    }
}
