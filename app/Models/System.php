<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/24
 * Time: 16:55
 * Desc：
 */

namespace App\Models;

use Eloquent as Model;

class System extends  Model
{

    public $table = 'systems';


    //protected $primaryKey = 'user_id';

    public $fillable = [
        'register_status',
        'review_status',
    ];

}