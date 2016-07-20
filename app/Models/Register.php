<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Register
 * @package App\Models\Admin
 */
class Register extends Model
{
    use SoftDeletes;

    public $table = 'registers';
    

    protected $dates = ['deleted_at'];

    //protected $primaryKey = 'user_id';

    public $fillable = [
        'user_id',
        'province',
        'gender',
        'email',
        'stature',
        'academy',
        'middleschool',
        'telphone',
        'postcode',
        'address',
        'family',
        'hobby',
        'reward',
        'personal',
        'certificate',
        'reason'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        /*'userid' => 'string',
        'province' => 'string',
        'gender' => 'string',
        'politics' => 'string',
        'stature' => 'string',
        'academy' => 'string',
        'profession' => 'string',
        'middleschool' => 'string',
        'telphone' => 'string',
        'postcode' => 'string',
        'address' => 'string',
        'family' => 'string',
        'hobby' => 'string',
        'reward' => 'string',
        'personal' => 'string',
        'certificate' => 'string',
        'video' => 'string',
        'state' => 'string'*/
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'province' => 'required',
        'email' => 'required|email|unique:users,email',
        'gender' => 'required',
        'stature' => 'required',
        'academy' => 'required',
        'middleschool' => 'required',
        'telphone' => 'required|regex:/([0-1])[0-9]{10}/',
        'postcode' => 'required',
        'address' => 'required',
        //'family' => 'required',
        'hobby' => 'required',
        //'reward' => 'required',
        'personal' => 'required',
        //'certificate' => 'required',
        'reason' => 'required',
    ];

    /**
     * @param array $attributes
     * @return mixed
     * 把家庭成员组合成json格式存储
     */
    public function setFamilyAttribute($family)
    {
        $this->attributes['family'] = json_encode($family);
    }

    public function getFamilyAttribute($family)
    {
       return json_decode($family);
    }

    public function setRewardAttribute($reward)
    {
        $this->attributes['reward'] = json_encode($reward);
    }

    public function getRewardAttribute($reward)
    {
        return json_decode($reward);
    }

    /*public function getStateAttribute($state)
    {
        return $state ? '<span class="label label-success">已审核</span>':'<span class="label label-warning">未审核</span>';
    }*/
}
