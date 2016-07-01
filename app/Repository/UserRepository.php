<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/7/1
 * Time: 11:18
 */

namespace App\Repository;


use App\User;
use Jiyis\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

}