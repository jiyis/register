<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/15
 * Time: 14:38
 */

namespace App\Repository;

use App\Models\Permission;
use Jiyis\Generator\Common\BaseRepository;

class PermissionRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    public function topPermissions()
    {
        return $this->model->where('fid', 0)->orderBy('sort', 'asc')->orderBy('id', 'asc')->get();
    }
    
}