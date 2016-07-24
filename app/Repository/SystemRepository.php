<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/24
 * Time: 16:53
 * Desc：
 */

namespace App\Repository;

use App\Models\System;
use Jiyis\Generator\Common\BaseRepository;
use App\Models\Register;

class SystemRepository extends BaseRepository
{
    public function model()
    {
        return System::class;
    }

    public function update(array $data,$id)
    {

        if($data['review_status'] == 0){
            if(Register::where('review_state',0)->count() > 0){
                return false;
            }
        }
        if ($data['register_status'] == 0){
            if(Register::where('register_state',0)->where('review_state',2)->count() > 0){
                return false;
            }
        }
        return parent::update($data,$id);
    }
}