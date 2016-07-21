<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/3
 * Time: 10:38
 */

namespace App\Http\Controllers\Admin;


use App\Repository\AdminUserRepository;
use App\Services\CommonServices;
use Breadcrumbs, Toastr;
use App\Http\Requests\Admin\CreateAdminUserRequest;
use App\Http\Requests\Admin\UpdateAdminUserRequest;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $adminUser;

    public function __construct(AdminUserRepository $adminuser)
    {
        parent::__construct();
        $this->adminUser = $adminuser;

        Breadcrumbs::register('admin-user', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('用户管理', route('admin.users.index'));
        });
        view()->share('roles', CommonServices::getRoles());
    }

    public function index()
    {
        Breadcrumbs::register('admin-user-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-user');
            $breadcrumbs->push('用户列表', route('admin.users.index'));
        });

        $users = $this->adminUser->paginate(10);
        return view('admin.rbac.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-user-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-user');
            $breadcrumbs->push('添加用户', route('admin.users.create'));
        });
        return view('admin.rbac.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminUserRequest $request)
    {
        $result = $this->adminUser->create($request->all());
        if(!$result) {
            Toastr::error('新用户添加失败!');
            return redirect(route('admin.users.create'));
        }
        Toastr::success('新用户添加成功!');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumbs::register('admin-user-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-user');
            $breadcrumbs->push('编辑用户', route('admin.users.edit', ['id' => $id]));
        });

        $user = $this->adminUser->find($id);
        //$hasRoles = $user->roles()->lists('id');
        //dd($user);
        return view('admin.rbac.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUserRequest $request, $id)
    {
        $user = $this->adminUser->findWithoutFail($id);

        if (empty($user)) {
            Toastr::error('用户未找到');

            return redirect(route('admin.users.index'));
        }
        if($request->get('password') == ''){
            $data = $request->except('password');
        }else{
            $data = $request->all();
        }
        $user = $this->adminUser->update($data, $id);

        Toastr::success('用户更新成功.');

        return redirect(route('admin.users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->adminUser->findWithoutFail($id);
        if (empty($user)) {
            Toastr::error('用户未找到');

            return response()->json(['status' => 0]);
        }
        $result = $this->adminUser->delete($id);
        //Toastr::success('用户删除成功');

        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
            $result = $this->adminUser->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}