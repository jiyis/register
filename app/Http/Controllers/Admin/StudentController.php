<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/1
 * Time: 23:14
 * Desc：
 */

namespace App\Http\Controllers\Admin;


use App\Repository\UserRepository;
use Breadcrumbs, Toastr;
use App\Http\Requests\Index\CreateUserRequest;
use App\Http\Requests\Index\UpdateUserRequest;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    protected $student;

    public function __construct(UserRepository $student)
    {
        parent::__construct();
        $this->student = $student;

        Breadcrumbs::register('admin-student', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('学生管理', route('admin.students.index'));
        });
    }

    public function index()
    {
        Breadcrumbs::register('admin-student-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-student');
            $breadcrumbs->push('学生列表', route('admin.students.index'));
        });

        $users = $this->student->paginate(10);

        return view('admin.students.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-student-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-student');
            $breadcrumbs->push('添加学生', route('admin.students.create'));
        });

        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $result = $this->student->create($request->all());
        if (!$result) {
            Toastr::error('新学生添加失败!');

            return redirect(route('admin.students.create'));
        }
        Toastr::success('新学生添加成功!');

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
        Breadcrumbs::register('admin-student-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-student');
            $breadcrumbs->push('编辑学生', route('admin.students.edit', ['id' => $id]));
        });

        $user = $this->student->find($id);
        //$hasRoles = $user->roles()->lists('id');
        //dd($user);
        return view('admin.students.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->student->findWithoutFail($id);

        if (empty($user)) {
            Toastr::error('学生未找到');

            return redirect(route('admin.students.index'));
        }
        $user = $this->student->update($request->all(), $id);

        Toastr::success('学生更新成功.');

        return redirect(route('admin.students.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->student->findWithoutFail($id);
        if (empty($user)) {
            Toastr::error('学生未找到');

            return redirect(route('admin.students.index'));
        }
        $result = $this->student->delete($id);


        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if (!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->student->delete($id);
        }

        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}