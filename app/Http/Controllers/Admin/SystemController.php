<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/24
 * Time: 16:52
 * Desc：
 */

namespace App\Http\Controllers\Admin;

use App\Repository\SystemRepository;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr, Response;

class SystemController extends BaseController
{
    protected $system;

    public function __construct(SystemRepository $system)
    {
        parent::__construct();
        $this->system = $system;

        Breadcrumbs::register('admin-system', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('系统配置管理', route('admin.systems.index'));
        });
    }

    public function index()
    {
        return $this->edit(1);
        Breadcrumbs::register('admin-system-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-system');
            $breadcrumbs->push('系统配置列表', route('admin.systems.index'));
        });

        $system = $this->system->all();

        return view('admin.systems.index', compact('system'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-system-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-system');
            $breadcrumbs->push('添加系统配置', route('admin.systems.create'));
        });
        return view('admin.systems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $result = $this->system->create($request->all());
        if (!$result) {
            Toastr::error('新系统配置添加失败!');

            return redirect(route('admin.systems.create'));
        }
        Toastr::success('新系统配置添加成功!');

        return redirect('admin/systems');
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
        Breadcrumbs::register('admin-system-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-system');
            $breadcrumbs->push('编辑系统配置', route('admin.systems.edit', ['id' => $id]));
        });

        $system = $this->system->find($id);
        //$hasRoles = $user->roles()->lists('id');
        //dd($user);
        return view('admin.systems.edit', compact('system'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $system = $this->system->findWithoutFail($id);

        if (empty($system)) {
            Toastr::error('系统配置未找到');

            return redirect(route('admin.systems.index'));
        }

        $system = $this->system->update($request->all(), $id);

        if($system){
            Toastr::success('系统配置更新成功.');
        }else{
            Toastr::error('还有学生未操作,请先操作后进行.');
        }


        return redirect(route('admin.systems.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->system->findWithoutFail($id);
        if (empty($user)) {
            Toastr::error('系统配置未找到');

            return redirect(route('admin.systems.index'));
        }
        $result = $this->system->delete($id);


        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}