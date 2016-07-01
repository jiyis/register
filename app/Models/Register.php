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

    protected $primaryKey = 'userid';

    public $fillable = [
        'user_id',
        'province',
        'gender',
        'politics',
        'stature',
        'academy',
        'profession',
        'middleschool',
        'telphone',
        'postcode',
        'address',
        'family',
        'hobby',
        'reward',
        'personal',
        'certificate',
        'video'
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
        'gender' => 'required',
        'politics' => 'required',
        'stature' => 'required',
        'academy' => 'required',
        'profession' => 'required',
        'middleschool' => 'required',
        'telphone' => 'required|regex:/([0-1])[0-9]{10}/',
        'postcode' => 'required',
        'address' => 'required',
        //'family' => 'required',
        'hobby' => 'required',
        'reward' => 'required',
        'personal' => 'required',
        'certificate' => 'required',
        'video' => 'required',
    ];
}
