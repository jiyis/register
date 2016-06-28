<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/12
 * Time: 11:02
 */

namespace App\Repository;

use App\Models\Role;
use Jiyis\Generator\Common\BaseRepository;


class RoleRepository extends BaseRepository
{

    public function model()
    {
        return Role::class;
    }

    /**
     * delete role
     * @param $id
     * @return bool|int
     */
    public function delete($id)
    {
        $role = $this->model->find($id);
        if(!$role) {
            return false;
        }
        $role->users()->detach();
        return parent::delete($id);
    }

    /**
     * save role permissions
     * @param $id
     * @param array $perms
     * @return bool
     */
    public function savePermissions($id, $perms = [])
    {
        $role = $this->model->find($id);
        $role->perms()->sync($perms);

        return true;
    }

    /**
     * get role's permissions
     * @param $id
     * @return array
     */
    public function rolePermissions($id)
    {
        $perms = [];
        $permissions = $this->model->find($id)->perms()->get();

        foreach ($permissions as $item) {
            $perms[$item->id] = $item->name;
        }

        return $perms;
    }
}