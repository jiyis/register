<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/15
 * Time: 14:36
 */

namespace App\Http\Controllers\Admin;


use App\Repository\PermissionRepository;
use App\Repository\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Toastr, Breadcrumbs;

class RoleController extends BaseController
{
    protected $role;
    protected $permission;

    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        parent::__construct();
        $this->role = $role;
        $this->permission = $permission;

        Breadcrumbs::register('admin-role', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('角色管理', route('admin.role.index'));
        });
    }

    /**
     * @return mixed
     */
    public function index()
    {
        Breadcrumbs::register('admin-role-index', function($breadcrumbs) {
           $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('角色列表', route('admin.role.index'));
        });
        $roles = $this->role->paginate(10);
        return view('admin.rbac.roles.index',compact('roles'));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        Breadcrumbs::register('admin-role-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('添加角色', route('admin.role.create'));
        });

        return view('admin.rbac.roles.create');
    }

    /**
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function store(CreateRoleRequest $request)
    {
        $result = $this->role->create($request->all());

        if(!$result) {
            Toastr::error('角色添加失败!');
            return redirect('admin/role/create');
        } else {
            Toastr::success('新角色添加成功!');
            return redirect('admin/role');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        Breadcrumbs::register('admin-role-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('编辑角色', route('admin.role.edit', ['id' => $id]));
        });

        $role = $this->role->find($id);
        return view('admin.rbac.roles.edit', compact('role'));
    }

    /**
     * @param UpdateRoleRequest $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = $this->role->findWithoutFail($id);

        if (empty($role)) {
            Toastr::error('角色未找到!');

            return redirect(route('admin.role.index'));
        }
        $role = $this->role->update($request->all(), $id);

        Toastr::success('角色更新成功!');

        return redirect(route('admin.role.index'));

    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $result = $this->role->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->role->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Display a role's permissions
     * @param $id
     * @return \Illuminate\View\View
     */
    public function permissions($id)
    {
        Breadcrumbs::register('admin-role-permission', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-role');
            $breadcrumbs->push('编辑角色权限', route('admin.role.permissions', ['id' => $id]));
        });

        $role = $this->role->find($id);
        $permissions = $this->permission->topPermissions();
        $rolePermissions = $this->role->rolePermissions($id);
        return view('admin.rbac.roles.permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Set role's permissions
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePermissions($id, Request $request)
    {
        $result = $this->role->savePermissions($id, $request->input('permissions', []));
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}